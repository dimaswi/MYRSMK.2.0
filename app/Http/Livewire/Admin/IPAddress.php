<?php

namespace App\Http\Livewire\Admin;

use App\Models\Stat;
use Livewire\Component;
use Livewire\WithPagination;

class IPAddress extends Component
{
    use WithPagination;
    public $perPage;

    public function render()
    {
        return view('livewire.admin.i-p-address',[
            'stats' => Stat::paginate(),
        ]);
    }
}
