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
use App\Models\Location;    
use App\Models\Operation;
class EditIncident extends Component
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

    public $landmark;
    public $address;
    public $location_name;
    public $latitude;
    public $longitude; 



    public function rules()
    {
        return [
            'incident.incident_type' => 'required',
            'incident.name' => 'max:35',        
            'incident.sex' =>  Rule::in(['male', 'female']),
            'incident.victim_status' => Rule::in(['Unconscious', 'Conscious']),
            'incident.age' => 'numeric',
            'incident.description' => 'max:255',
            'incident.permanent_address' => 'max:255',

            //'location.location_type' => ['required', Rule::in(['incident', 'important_location'])],
            'location.landmark'      => 'max:35',
            'location.address'       => 'required|max:35',
            'location.longitude'     => 'required',
            'location.latitude'      => 'required'
            
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

 


    public function add()
    {
        
        
       
        //dd($this->selectedUser);
        // Validate First the inputs before creating
       // Validate First the inputs before creating 
       $validatedData = $this->validate();
       

       // dd($this->selectedUser);
        /*
        If a unit is selected, add an operation
        If not, only add it to the incident
        */
       
       
        if ( !is_null($this->selectedUser) && $this->incident->incident_status == 'Pending'){
            // Create a user
            
            $this->incident->incident_status = 'Ongoing';
            $this->incident->save();
            $this->location->save();
           
             $this->operation = Operation::create([
                'incident_id' => $this->incident->incident_id,
                //'responder_id' => $this->account_id,
                'dispatcher_id' => $this->user->id,
                'unit_name' => $this->selectedUser
            ]);
            $unit_name = $this->selectedUser;
            // Get tokens 
	        //$conn =  mysqli_connect("localhost", "root", "","erbackend");
            $conn =     mysqli_connect("localhost", "chard","pasacaoers12345","pasacaoers_db");
  
            $sql = "SELECT tokens.token FROM tokens INNER JOIN accounts ON tokens.account_id = accounts.id WHERE accounts.unit_name = '".$unit_name."'";
            if($this->bfp == true){
                $sql .= " OR accounts.account_type = 'BFP'";
            }
            
            if($this->pnp == true) {
                $sql .= " OR accounts.account_type = 'PNP'";
            }
            
            $result = mysqli_query($conn, $sql);
            $tokens = array();

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $tokens[] = $row["token"];
                }
            }
            
            $query = "SELECT operations.operation_id, operations.unit_name, operations.external_agency_id, incidents.*, locations.* FROM operations INNER JOIN incidents ON operations.incident_id = incidents.incident_id INNER JOIN locations ON incidents.location_id = locations.location_id WHERE incidents.incident_status = 'ongoing' AND unit_name = '".$unit_name."' ORDER BY operation_id DESC";
        
               
            $r = mysqli_query($conn, $query);
            $operation = $r->fetch_assoc();
                      
  
            mysqli_close($conn);
            
            // Notify the responders
            $data = array(
              'title' => $operation['incident_type'],
              'body' => $operation['description'],
              '"operation"' => $operation,
            );
            
         
            $message_status = $this->send_notification($tokens, $data);
            
            
            
            
            $this->showAddAlert = true;   
            return redirect('/incidents');
            
        }else{
           
            dd("Incident is not pending or There's no responder");
            
        }
        // Pop up a alert message.
       
    }


    public function mount( $id)
    {
        
        $this->user = auth()->user();
        $existingUser = Incident::where('incident_id', $id)->first();
       
        $this->location = Location::where('location_id', $existingUser->location_id)->first();
        $this->urlId = intval($existingUser->id);
        $this->incident = $existingUser; 
        
        
    }
    public function render()
    {
        //view('livewire.new-user', ['account_types' => ['Responder', 'Reporter', 'Dispatcher']]
        return view('livewire.edit-incident',[
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