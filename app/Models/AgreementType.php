<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 契約種別
 */
class AgreementType extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name'];

    protected function agreements()
    {
        return $this->hasMany(Agreement::class);
    }
}
