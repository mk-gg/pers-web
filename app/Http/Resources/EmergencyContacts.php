<?php
  
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyContacts extends JsonResource
{

    public function toArray($request)
    {
        return [

            'contact_id' => $this->contact_id,
            'contact_name' => $this->contact_name,
            'contact_number' => $this->contact_number,
            'account_id' => $this->account_id,

           
        ];
    }
    
}