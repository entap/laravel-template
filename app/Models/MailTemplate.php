<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(MailType::class, 'mail_type_id');
    }
}
