<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPropertyValue extends Model
{
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(AdminProperty::class, 'property_id');
    }
}