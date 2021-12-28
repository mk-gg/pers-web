<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
   protected $fillable = [
        'first_name',
        'last_name',
        'sex',
        'email',
        'password',
        'account_type',
        'birthday',
        'address',
        'mobile_no',
        'unit_name',
        'city_municipality',
        'zip_code',
        
    ];

    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
