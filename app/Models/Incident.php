<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Incident extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $primaryKey = 'incident_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
   protected $fillable = [
        'incident_type',
        'name',
        'sex',
        'age',
        'description',
        'location_id',
        'account_id',
        'location',
        'incident_status',
        'victim_status',
        'temperature',
        'pulse_rate',
        'respiration_rate',
        'blood_pressure',
        'permanent_address'
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
