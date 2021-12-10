<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Incident;
use Livewire\WithPagination;

class Incidents extends Component
{
    use WithPagination;

    public Incident $incident;

    public function render()
    {
        return view('livewire.incidents',[

            'incidents' => Incident::latest()->paginate(10)
        ]);
    }
}
