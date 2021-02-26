<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 契約
 */
class Agreement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function type()
    {
        return $this->belongsTo(AgreementType::class, 'agreement_type_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_agreement');
    }
}
