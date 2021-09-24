<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public $timestamps = false; 

    protected $fillable = [
        'name',
        'login',
        'password',
        'type',
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'user_id', 'id');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\Phones', 'user_id', 'id')->where('firm', 'nokia');
    }
}
