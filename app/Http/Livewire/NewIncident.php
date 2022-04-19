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
    // General Information tab
    public $name = '';
    public $sex = '';
    public $age= ''; 
    public $incident_type;
    public $location_id = 1;
    public $description;
    public $account_id;
    public $selectedUser;
    public $showAddAlert = false;
    public $status;
    public $victim_status = '';
    public $permanent_address;


    public $landmark;
    public $location_name;
    public $address;
    public $longitude;
    public $latitude;


    public function rules()
    {
        return [
            'incident_type' => ['required', Rule::in(['Medical Emegency', 'Vehicle Accident', 'Theft or Robbery', 'Assault', 'Fire Incident', 'Drowning', 'Other'])] ,
            'description' => 'max:45',
            'name' => 'max:45',
            'victim_status' => ['required', Rule::in(['Unconscious', 'Conscious'])],
            'sex' =>  Rule::in(['male', 'female']),
            'age' => 'numeric',
            'permanent_address' => 'max:85',
            
            'landmark' => 'max:35',
            'location_name' => 'max:35',
            'address' => 'required|max:85',
            'longitude' => 'numeric',
            'latitude' => 'numeric'
            
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
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
     
        $validatedData = $this->validate();
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
                'location_id' => $this->location_id,
                'account_id' => $this->account_id,
                'victim_status' => $this->victim_status,
                'incident_status' => 'Critical',
            ]);

            $this->location = Location::create([
                'incident_type' => 'incident',
                'landmark' => $this->landmark,
                'location_name' => $this->location_name,
                'address' => $this->address,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude
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
                'location_id' => $this->location_id,
                'account_id' => $this->account_id,
                
                'incident_status' => $this->status,
                'victim_status' => 'Critical',
            ]);
          
           $this->operation = Operation::create([
                'incident_id' => $this->incident->incident_id,
                //'responder_id' => $this->account_id,
                'dispatcher_id' => $this->user->id,
                'unit_name' => $this->selectedUser
                ]);
            
            $this->location = Location::create([
                'incident_type' => 'incident',
                'landmark' => $this->landmark,
                'location_name' => $this->location_name,
                'address' => $this->address,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude
            ]);
            $unit_name = $this->selectedUser;
            // Get tokens 
            $conn =  mysqli_connect("localhost", "root", "","erbackend");

            // $conn =  mysqli_connect("localhost", "chard", "pasacaoers12345","pasacaoers_db");
  
           
            $sql = "SELECT operations.operation_id, operations.unit_name, operations.external_agency_id, incidents.*, locations.* FROM operations INNER JOIN incidents ON operations.incident_id = incidents.incident_id INNER JOIN locations ON incidents.location_id = locations.location_id WHERE incidents.incident_status = 'ongoing' AND unit_name = '".$unit_name."' ORDER BY operation_id DESC";
            
            $result = mysqli_query($conn, $sql);
            $tokens = array();

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    $tokens[] = $row["token"];
                }
            }

            mysqli_close($conn);

            // Notify the responders
            $message = array("message" => " FCM PUSH TEST");
            $message_status = $this->send_notification($tokens, $message);
            
            
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
    

    public function send_notification($tokens, $message, ) {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $tokens,
            'data' => $message
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