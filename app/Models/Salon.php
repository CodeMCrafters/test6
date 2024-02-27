<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'phone',
        'work_day',
        'work_time',
        'linkWebSites',
        'logo_path',
    ];

    public function showSalon(){
        return $this->select('id','name')->get();
    }
}
