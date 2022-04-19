<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewLocations extends Component
{

    public Location $location;
    public $location_type = '';
    public $landmark = '';
    public $address = '';
    public $location_name = '';
    public $latitude = '';
    public $longitude = ''; 
  
    public $showAddAlert = false;



    public function rules()
    {

        return [
            'location_type' => ['required', Rule::in(['incident', 'important_location'])],
            'landmark'      => 'max:35',
            'address'       => 'required|max:35',
            'location_name' => 'max:35',
            //'longitude'     => 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',
            //'latitude'      => 'regex:/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/',

        ];
        
   
    }

   public function updated($propertyName)
   {
       $this->validateOnly($propertyName);
   }
    
    public function add()
    {
       
 
    // Validate First the inputs before creating 
       $validatedData = $this->validate();
      
      
        // Create a location
        $this->location = Location::create([
            'location_type' => $this->location_type,
            'landmark' => $this->landmark,
            'address' => $this->address,
            'location_name' => $this->location_name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
            
        ]);
    
        // Pop up a alert message.
        $this->showAddAlert = true;

        return redirect('/locations');
    }


    public function render()
    {
        //view('livewire.new-user', ['account_types' => ['Responder', 'Reporter', 'Dispatcher']]
        return view('livewire.new-locations');
        
    }
    
}