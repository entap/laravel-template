<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPropertyGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function properties()
    {
        return $this->belongsToMany(
            AdminProperty::class,
            'admin_property_group_property',
            'property_group_id',
            'property_id'
        );
    }
}

// TODO 並べ替えたい
