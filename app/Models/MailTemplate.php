<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'from',
        'to',
        'subject',
        'body',
        'mail_type_id',
        'status',
        'starts_at',
        'expires_at',
    ];

    protected $attributes = [
        'status' => 'available',
    ];

    protected $dates = ['starts_at', 'expires_at'];

    public function type()
    {
        return $this->belongsTo(MailType::class, 'mail_type_id');
    }

    public function scopeTyped($query, int $typeId)
    {
        return $query->where('mail_type_id', $typeId);
    }

    public function isAvailable()
    {
        return $this->status === 'available' &&
            $this->hasStarted() &&
            !$this->hasExpired();
    }

    public function isUnavailable()
    {
        return !$this->isAvailable();
    }

    public function hasStarted()
    {
        if (empty($this->starts_at)) {
            return true;
        }
        return now()->gt($this->starts_at);
    }

    public function hasExpired()
    {
        if (empty($this->expires_at)) {
            return false;
        }
        return now()->gt($this->expires_at);
    }
}
