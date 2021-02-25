<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 意見、問い合わせ
 */
class UserOpinion extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
