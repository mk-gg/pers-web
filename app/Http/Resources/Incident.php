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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'sex' => $this->sex,
            'age' => $this->age,
            'description' => $this->description,
            'date_time_reported' => $this->date_time_reported,
            'location_id' => $this->location_id,
            'account_id' => $this->account_id,
            'location' => $this->location,
            'status' => $this->status
        ];
    }
    
}