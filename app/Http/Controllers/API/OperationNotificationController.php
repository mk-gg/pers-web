<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Incident;
use App\Models\Operation;
use Illuminate\Validation\Rule;
use App\Http\Resources\Incident as IncidentResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class OperationNotificationController extends BaseController
{

  public function send(Request $request)
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'incident_type' => 'required',
      'name' => 'nullable',
      'sex' => 'required',
      'age' => 'required',
      'description' => 'nullable',
      'account_id' => 'required',
      'location_id' => 'required',
      'incident_status' => ['required', Rule::in(['Pending', 'Completed', 'Ongoing'])],
      'victim_status' => ['required', Rule::in(['Conscious', 'Unconscious'])],
      'temperature' => 'nullable',
      'pulse_rate' => 'nullable',
      'respiration_rate' => 'nullable',
      'blood_pressure' => 'nullable',
      'permanent_address' => 'nullable'
    ]);

    if ($validator->fails()) {
      return $this->sendError($validator->errors());
    }

    $incident = Incident::create($input);

    $operation = Operation::create([
      'incident_id' => $incident->incident_id,
      'dispatcher_id' => '1',
    ]);

    $conn = mysqli_connect("localhost", "chard", "pasacaoers12345", "pasacaoers_db");

    $sql = "SELECT tokens.token FROM tokens INNER JOIN accounts ON tokens.account_id = accounts.id WHERE accounts.account_type = 'BFP'";

    $result = mysqli_query($conn, $sql);
    $tokens = array();

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $tokens[] = $row["token"];
      }
    }

    $query = "SELECT operations.operation_id, operations.unit_name, operations.external_agency_id, incidents.*, locations.* FROM operations INNER JOIN incidents ON operations.incident_id = incidents.incident_id INNER JOIN locations ON incidents.location_id = locations.location_id WHERE operations.operation_id = " . $operation->operation_id;

    $r = mysqli_query($conn, $query);
    $op = $r->fetch_assoc() or die($conn->error);

    // Notify the responders
    $data = array(
      'title' => $operation['incident_type'],
      'body' => $operation['description'],
      '"operation"' => $op,
    );
    
     mysqli_close($conn);

    $message_status = $this->send_notification($tokens, $data);
   
    return $this->sendResponse($message_status, 'post fetched');
  }

  public function send_notification($tokens, $data,)
  {
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
      'registration_ids' => $tokens,
      'data' => $data,
    );

    $headers = array(
      'Authorization:key = AAAA-1zFtK4:APA91bGndaTfaEXZwoVOcwRlgdJMqx9SxijhmKbIDYDgSsIT72ykpoOvN2E9PQHkifWEAecAf6lRJNHLB-xBMLgUGY6gkT2NAVifBiyjagRYPHORp7PMujSPuspf-ZKRCPn3blNOFHjP',
      'Content-Type: application/json'

    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);

    if ($result == FALSE) {
      die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
  }
}
