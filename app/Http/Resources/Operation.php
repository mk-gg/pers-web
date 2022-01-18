<?php
  
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Operation extends JsonResource
{

    public function toArray($request)
    {
        return [
      


            'operation_id' => $this->operation_id,
            'incident_id' => $this->incident_id,
            'responder_id' => $this->responder_id,
            'dispatcher_id' => $this->dispatcher_id,
            'external_agency_id' => $this->external_agency_id,
            'etd_base' => $this->etd_base,
            'eta_scene' => $this->eta_scene,
            'etd_scene' => $this->etd_scene,
            'eta_hospital' => $this->eta_hospital,
            'etd_hospital' => $this->etd_hospital,
            'receiving_facitility' => $this->receiving_facitility,
        ];
    }
    
}