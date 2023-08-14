<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    function customers()
    {
        return $this->hasMany(Customer::class, 'city_id');
    }
}
