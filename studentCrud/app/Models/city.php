<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;
    protected $fillable = ['name','population'];
    
    public function students()
    {
        return $this->hasMany(Student::class, 'city_id');
    }
}
