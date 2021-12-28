<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use Livewire\WithPagination;

class Locations extends Component
{
    use WithPagination;

    public Location $location;

    public function render()
    {
        return view('livewire.locations',[

            'locations' => Location::latest()->paginate(10)
        ]);
    }
}
