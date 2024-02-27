<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provide extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'id_salon',
        'time',
        'about',
        'price'
    ];

    
}
