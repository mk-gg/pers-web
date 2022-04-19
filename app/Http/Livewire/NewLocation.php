<?php

namespace App\Http\Livewire;

use App\Models\Location;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use App\Http\Livewire\Input;
use App\Models\Incident;

class NewLocation extends Component
{
    public Location $location;
    public $location_type;
    public $address;
    public $longitude;
    public $latitude; 
    public $landmark;

    public $showAddAlert = false;




    public function rules()
    {
        return [
            'location_type' => Rule::in(['incident', 'important_location']),
            'address' => 'required|max:30',
            'longitude' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        ];
    }

    
    public function add()
    {
        
        //Validate First the inputs before creating    
        $this->validate();
        // Create a user
        // $this->location = Location::create([
        //     'location_type' => $this->location_type,
        //     'address' => $this->address,
        //     'landmark' => $this->landmark,
        //     'longitude' => $this->longitude,
        //     'latitude' => $this->latitude,
        // ]);
        
        // Pop up a alert message.
        $this->showAddAlert = true;   
      //  return redirect('/locations');
    }


    public function render()
    {
        //view('livewire.new-user', ['account_types' => ['Responder', 'Reporter', 'Dispatcher']]
        return view('livewire.new-location');
        
    }
    
}