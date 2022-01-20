<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Operation;
use Livewire\WithPagination;

class Operations extends Component
{
    use WithPagination;

    public Operation $operation;

    public function render()
    {
        return view('livewire.operations',[

            'operations' => Operation::latest()->paginate(10)
        ]);
    }
}
