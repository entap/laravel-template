<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 意見
 */
class UserOpinion extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'body', 'email'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
