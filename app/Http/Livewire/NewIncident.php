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
use App\Models\Location;
class NewIncident extends Component
{
    public Account $user;
    public Incident $incident;
    public Operation $operation;
    public Location $location;
    public $name;
    public $last_name;
    public $sex;
    public $age; 
    public $incident_type;
    public $victim_status;

    public $description;
    public $account_id;
    public $selectedUser;
    public $showAddAlert = false;
    public $status;
    public $bfp;
    public $pnp;
    public $permanent_address;

    public $landmark = '';
    public $address = '';
    public $location_name = '';
    public $latitude;
    public $longitude; 



    public function rules()
    {
        return [
            'name' => 'max:35',
            'sex' =>  Rule::in(['male', 'female']),
            'victim_status' => Rule::in(['Unconscious', 'Conscious']),
            'age' => 'numeric',
            'description' => 'max:255',
            'incident_type' => 'required',
            
        ];
    }

    public function updatedEmail()
    {
        $this->validate(['email'=>'required|email:rfc,dns|unique:accounts']);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount() { $this->user = auth()->user(); }


    public function add()
    {
        
  
        //dd($this->landmark);   
        //dd($this->selectedUser);
        // Validate First the inputs before creating
       // Validate First the inputs before creating 
       $validatedData = $this->validate();
       //$conn =  mysqli_connect("localhost", "root", "","erbackend");
       $conn = mysqli_connect("localhost", "chard","pasacaoers12345","pasacaoers_db");
      
       // dd($this->selectedUser);
        /*
        If a unit is selected, add an operation
        If not, only add it to the incident
        */
        $this->location = Location::create([
            'location_type' => 'incident',
            'landmark' => $this->landmark,
            'address' => $this->address,
            'location_name' => $this->location_name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
            
        ]);

        $sql = "SELECT tokens.token FROM tokens INNER JOIN accounts ON tokens.account_id = accounts.id WHERE";

   
        if (!is_null($this->selectedUser))
        {
            $sql .= " accounts.unit_name = '".$this->selectedUser."'";
            if($this->bfp == true || $this->pnp == true){
                $sql .= " OR";
            }
            $this->status = "Ongoing";
            
        }

        if($this->bfp == true){
            $sql .= " accounts.account_type = 'BFP'";
            if($this->pnp == true){
                $sql .= " OR";
            }
          }
          
        if($this->pnp == true) {
            $sql .= " accounts.account_type = 'PNP'";
        }


        if(($this->bfp == true || $this->pnp == true) && is_null($this->selectedUser))
        {
            $this->status = 'Completed';
        }
        
        $this->incident = Incident::create([
            'name' => $this->name,
            'sex' => strtolower($this->sex),
            'age' => $this->age,
            'description' => $this->description,
            'incident_type' => $this->incident_type,
            'location_id' => $this->location->location_id,
            'account_id' => $this->account_id,
            'victim_status' =>  $this->victim_status,
            'incident_status' => $this->status,
            'permanent_address' => $this->permanent_address,
        ]);
        

        if ($this->bfp == true || $this->pnp == true || !is_null($this->selectedUser))
        {
            $this->operation = Operation::create([
                'incident_id' => $this->incident->incident_id,
                //'responder_id' => $this->account_id,
                'dispatcher_id' => $this->user->id,
                'unit_name' => $this->selectedUser
                ]);

                $result = mysqli_query($conn, $sql);
                $tokens = array();
       
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $tokens[] = $row["token"];
                    }
                }
       
               
                $query = "SELECT operations.operation_id, operations.unit_name, operations.external_agency_id, incidents.*, locations.* FROM operations INNER JOIN incidents ON operations.incident_id = incidents.incident_id INNER JOIN locations ON incidents.location_id = locations.location_id WHERE operations.operation_id = ".$this->operation->operation_id;
            
                   
                $r = mysqli_query($conn, $query);
                $operation = $r->fetch_assoc() or die($conn->error);
                          
      
                
                
                // Notify the responders
                $data = array(
                  'title' => $operation['incident_type'],
                  'body' => $operation['description'],
                  '"operation"' => $operation,
                );
                
              $message_status = $this->send_notification($tokens, $data);
      
              
              
             
              
              mysqli_close($conn);
      
        }
    
  
         
      

    
            
            
        $this->showAddAlert = true;   
        return redirect('/incidents');
        

        
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
    

    public function send_notification($tokens, $data, ) {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $tokens,
            'data' => $data,
        );

        $headers = array (
            'Authorization:key = AAAA-1zFtK4:APA91bGndaTfaEXZwoVOcwRlgdJMqx9SxijhmKbIDYDgSsIT72ykpoOvN2E9PQHkifWEAecAf6lRJNHLB-xBMLgUGY6gkT2NAVifBiyjagRYPHORp7PMujSPuspf-ZKRCPn3blNOFHjP',
            'Content-Type: application/json'

        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        if ($result == FALSE) {
            die('Curl failed: '. curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}