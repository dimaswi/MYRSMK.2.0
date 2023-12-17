<?php

namespace App\Http\Livewire\Logbook;

use App\Models\Logbook;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class LogbookIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $perpage = 5;

    public function render()
    {
        return view('livewire.logbook.logbook-index',[
            'logbooks' => Logbook::search($this->search)->groupBy('nama')->paginate($this->perpage),
        ]);
    }

    public function showDetails($uid)
    {
        return redirect()->to("/logbook/detail/$uid");
    }
}
