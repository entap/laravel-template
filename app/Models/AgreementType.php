<?php

namespace App\Models;

use App\Models\Agreement;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function hasNewAgreements(Carbon $createdAt)
    {
        return $this->agreements()
            ->where('created_at', '>', $createdAt)
            ->count() > 0;
    }
}
