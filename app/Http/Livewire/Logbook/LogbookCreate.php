<?php

namespace App\Http\Livewire\Logbook;

use App\Models\JamKerja;
use App\Models\Logbook;
use App\Models\Unit;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class LogbookCreate extends Component
{
    use LivewireAlert;
    public $judul;
    public $jenis_shift;
    public $shift;
    public $jam_kerja;
    public $nama;
    public $kegiatan;
    public $unit;
    public $lokasi;
    public $bersama;

    public function render()
    {
        $jadwal_terpakai = Logbook::whereDate('created_at', Carbon::today())->pluck('jam_kerja');

        return view('livewire.logbook.logbook-create', [
            'logbooks' => Logbook::where('nama', auth()->user()->name)->whereDate('created_at', Carbon::today())->get(),
            'jadwal_manajemens' => JamKerja::where('shift', 'Manajemen')->whereNotIn('jam_kerja', $jadwal_terpakai)->get(), 
            'jadwal_pagis' => JamKerja::where('shift', 'Pagi')->whereNotIn('jam_kerja', $jadwal_terpakai)->get(), 
            'jadwal_siangs' => JamKerja::where('shift', 'Siang')->whereNotIn('jam_kerja', $jadwal_terpakai)->get(), 
            'jadwal_malams' => JamKerja::where('shift', 'Malam')->whereNotIn('jam_kerja', $jadwal_terpakai)->get(), 
        ]);
    }

    public function set($value)
    {
        $this->jenis_shift = $value;
        $this->judul = $value;
    }

    public function store()
    {
        $cek_jam = Logbook::where('jam_kerja', $this->jam_kerja)->whereDate('created_at', Carbon::today())->first();

        if ($cek_jam === null) {
            try {
                $validate = $this->validate([
                    'shift' => 'required',
                    'jam_kerja' => 'required',
                    'lokasi' => 'required',
                    'bersama' => 'required',
                    'kegiatan' => 'required',
                ]);

                $unit = Unit::where('id', auth()->user()->unit)->first();

                Logbook::create([
                    'uid' => Carbon::now('Asia/Jakarta')->format('Ymd'),
                    'shift' => $this->shift,
                    'jam_kerja' => $this->jam_kerja,
                    'lokasi' => $this->lokasi,
                    'bersama' => $this->bersama,
                    'kegiatan' => $this->kegiatan,
                    'nama' => auth()->user()->name,
                    'unit' => $unit->nama,
                ]);

                $this->reset(['jam_kerja', 'lokasi', 'bersama', 'kegiatan']);
                $this->sendAlert('success', 'Berhasil disimpan!!', 'top-end');
            } catch (\Throwable $th) {
                $this->sendAlert('error', $th->getMessage(), 'top-end');
            }
            
        } else {
            $this->sendAlert('error', 'Jam kerja sudah ada!!', 'top-end');
        }
    }

    public function remove($id)
    {
        try {
            Logbook::where('id', $id)->delete();
            $this->sendAlert('success', 'Berhasil dihapus!!', 'top-end');
        } catch (\Throwable $th) {
            $this->sendAlert('error', $th->getMessage(), 'top-end');
        }
    }

    public function sendAlert($tipo, $texto, $posicion)
    {
        $this->alert($tipo, $texto, [
            'position' =>  $posicion,
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
}
