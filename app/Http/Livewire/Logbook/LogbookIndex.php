<?php

namespace App\Http\Livewire\Logbook;

use App\Models\Logbook;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
class LogbookIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $perpage = 5;

    public function render()
    {
        if (! Gate::allows('manage_logbook_veifikator')) {
            return abort(401);
        }

        return view('livewire.logbook.logbook-index',[
            'logbooks' => Logbook::search($this->search)->groupBy('uid')->paginate($this->perpage),
        ]);
    }

    public function showDetails($uid)
    {
        return redirect()->to("/logbook/detail/$uid");
    }
}
