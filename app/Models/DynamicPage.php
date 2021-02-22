<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicPage extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    public function contents()
    {
        return $this->hasMany(DynamicContent::class);
    }
}
