<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Input;
use App\Models\Incident;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Account;
use App\Models\Operation;
class NewIncident extends Component
{
    public Account $user;
    public Incident $incident;
    public Operation $operation;
    public $name;
    public $last_name;
    public $sex;
    public $age; 
    public $incident_type;
    public $location ;
    public $location_id = 1;
    public $description;
    public $account_id;
    public $selectedUser;
    public $showAddAlert = false;
    public $status;




    public function rules()
    {
        return [
            'name' => 'max:35',
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


    public function mount() { $this->user = auth()->user(); }

    public function add()
    {
       
        //dd($this->selectedUser);
        // Validate First the inputs before creating
        $this->validate([
            'name' => 'max:35',
           // 'sex' => 'in::male,female',
            'description' => 'max:20',
            'incident_type' => 'required',
            'location' => 'required',
            'account_id' => 'required',
        ]);
        
        
       // dd($this->selectedUser);
        /*
        If a unit is selected, add an operation
        If not, only add it to the incident
        */
        if ( is_null($this->selectedUser)){
            // Create a user
            $this->status = 'Pending';
            $this->incident = Incident::create([
                'name' => $this->name,
                'sex' => strtolower($this->sex),
                'age' => $this->age,
                'description' => $this->description,
                'incident_type' => $this->incident_type,
                'location' => $this->location,
                'location_id' => $this->location_id,
                'account_id' => $this->account_id,
          
                'status' => $this->status,
            ]);
            $this->showAddAlert = true;   
            return redirect('/incidents');
            
        }else{
            $this->status = 'Ongoing';
            $this->incident = Incident::create([
                'name' => $this->name,
                'sex' => strtolower($this->sex),
                'age' => $this->age,
                'description' => $this->description,
                'incident_type' => $this->incident_type,
                'location' => $this->location,
                'location_id' => $this->location_id,
                'account_id' => $this->account_id,
     
                'status' => $this->status,
            ]);
          
           $this->operation = Operation::create([
                'incident_id' => $this->incident->incident_id,
                //'responder_id' => $this->account_id,
                'dispatcher_id' => $this->user->id,
                'unit_name' => $this->selectedUser
                ]);
            
            $this->showAddAlert = true;   
            return redirect('/incidents');
        }
        // Pop up a alert message.
       
    }


    public function render()
    {
        //view('livewire.new-user', ['account_types' => ['Responder', 'Reporter', 'Dispatcher']]
        return view('livewire.new-incident',[
            'users' => Account::all(),
            //'users' => Account::latest()->paginate(10) 
        ]);
      
    }
    
}