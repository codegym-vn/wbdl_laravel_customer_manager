<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'email', 'dob'];

    function city()
    {
        return $this->belongsTo(City::class);
    }
}
