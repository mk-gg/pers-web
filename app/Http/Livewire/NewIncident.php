<?php

namespace App\Http\Livewire;

use App\Models\Incident;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewIncident extends Component
{
    public Incident $incident;
    public $first_name;
    public $last_name;
    public $sex;
    public $age; 
    public $incident_type;
    public $location ;
    public $location_id = 1;
    public $description;
    public $account_id;

    public $showAddAlert = false;




    public function rules()
    {
        return [
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'sex' => 'in::male,female',
            'age' => 'numeric',
            'description' => 'max:20',
            'incident_type' => 'required',
            'location' => 'required',
        ];
    }

    public function updatedEmail()
    {
        $this->validate(['email'=>'required|email:rfc,dns|unique:accounts']);
    }


    
    public function add()
    {
        
        // Validate First the inputs before creating
        $this->validate([
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'sex' => 'in::male,female',
            'age' => 'numeric',
            'description' => 'max:20',
            'incident_type' => 'required',
            'location' => 'required',
            'account_id' => 'required',
        ]);
        
        // Create a user
        $this->incident = Incident::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'sex' => strtolower($this->sex),
            'age' => $this->age,
            'description' => $this->description,
            'incident_type' => $this->incident_type,
            'location' => $this->location,
            'location_id' => $this->location_id,
            'account_id' => $this->account_id,
            'date_time_reported' => now(),
        
        ]);
        
        // Pop up a alert message.
        $this->showAddAlert = true;   
        return redirect('/incidents');
    }


    public function render()
    {
        //view('livewire.new-user', ['account_types' => ['Responder', 'Reporter', 'Dispatcher']]
        return view('livewire.new-incident');
        ;
    }
    
}