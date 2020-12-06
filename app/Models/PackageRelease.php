<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageRelease extends Model
{
    use HasFactory;

    protected $fillable = ['version', 'uri', 'publish_date', 'expire_date'];

    protected $dates = ['publish_date', 'expire_date'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function scopePublished($query)
    {
        return $query->where('publish_date', '>=', now());
    }
}
