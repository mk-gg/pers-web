<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EmergencyContacts extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $primaryKey = 'contact_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    
   protected $fillable = [
        'contact_name',
        'contact_number',
        'account_id',
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
