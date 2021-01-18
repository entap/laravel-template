<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProperty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'display_name', 'description', 'type_id'];

    public function type()
    {
        return $this->belongsTo(AdminPropertyType::class, 'type_id');
    }

    public function values()
    {
        return $this->hasMany(AdminPropertyValue::class, 'property_id');
    }

    public function groups()
    {
        return $this->belongsToMany(
            AdminPropertyGroup::class,
            'admin_property_group_property',
            'property_group_id',
            'property_id'
        );
    }

    public function scopeIndependent(Builder $query)
    {
        return $query->whereDoesntHave('groups');
    }
}

// TODO 並べ替えたい
// TODO デフォルト値を設定できるようにしたい
