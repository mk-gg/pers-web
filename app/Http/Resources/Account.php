<?php
  
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'account_type' => $this->account_type,
            'password' => $this->password,
            'mobile_no' => $this->mobile_no,
            'birthday' => $this->birthday,
            'sex' => $this->sex,
            'address' => $this->address,
            'unit_name' => $this->unit_name,
            'city_municipality' => $this->city_municipality,
            'zip_code' => $this->zip_code,
            'province' => $this->province,
            'status' => $this->status,
           
            
            
            
        ];
    }
    
}