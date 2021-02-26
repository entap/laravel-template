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

    protected $fillable = ['description'];

    protected $attributes = [
        'version' => 1,
    ];

    public function type()
    {
        return $this->belongsTo(AgreementType::class, 'agreement_type_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * 新しいバージョンを作る
     */
    public function newVersion(): Agreement
    {
        $newVersion = $this->replicate();
        $newVersion->version += 1;
        return $newVersion;
    }
}
