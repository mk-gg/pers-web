<?php
  
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Location extends JsonResource
{

    public function toArray($request)
    {
        return [

            'location_id' => $this->location_id,
            'location_type' => $this->location_type,
            'address' => $this->address,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        ];
    }
    
}