<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
protected $fillable = ['name', 'age', 'gender', 'city_id', 'image'];
    // public function city()
    // {
    //     return $this->belongsTo(City::class, 'city_id');
    // }
    
}