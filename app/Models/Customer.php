<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'phone_number', 'enterprise_id', 'identity_number', 'password', 'uid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'uid'
    ];

    function enterprise(){
        return $this->belongsTo(Enterprise::class);
    }

    function orders(){
        return $this->hasMany(Order::class);
    }

    function loans(){
        return $this->hasMany(Loan::class);
    }

}
