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
}
