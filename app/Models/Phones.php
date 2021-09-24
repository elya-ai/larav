<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    public $timestamps = false;
    public $fillable = [
    	'firm', 'price', 'user_id',
    ];
}
