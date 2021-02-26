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

    protected $fillable = ['slug', 'name', 'confirmation_mode'];

    public function agreements()
    {
        return $this->hasMany(Agreement::class);
    }

    public function isStrictMode()
    {
        return $this->confirmation_mode === 'strict';
    }
}
