<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Operation extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $primaryKey = 'operation_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
   protected $fillable = [
        'incident_id',
        'reporter_id',
        'dispatcher_id',
        'external_agency_id',
        'unit_name',
        'etd_base' ,
        'eta_scene' ,
        'etd_scene',
        'eta_hospital',
        'etd_hospital' ,
        'eta_base',
        'receiving_facility'
        
    ]; 
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    */
}
