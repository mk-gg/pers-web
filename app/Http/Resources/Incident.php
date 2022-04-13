<?php
  
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Incident extends JsonResource
{


    public function toArray($request)
    {
        return [
          
        
            'incident_id' => $this->incident_id,
            'incident_type' => $this->incident_type,
            'name' => $this->name,
            'sex' => $this->sex,
            'age' => $this->age,
            'description' => $this->description,
            'location_id' => $this->location_id,
            'account_id' => $this->account_id,
            'incident_status' => $this->incident_status,
            'victim_status' => $this->victim_status,
            'temperature' => $this->temperature,
            'pulse_rate' => $this->pulse_rate,
            'respiration_rate' => $this->respiration_rate,
            'blood_pressure' => $this->blood_pressure,
            'permanent_address' => $this->permanent_address
        ];
    }
    
}