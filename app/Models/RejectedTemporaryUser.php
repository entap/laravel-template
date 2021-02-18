<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 否認された仮登録ユーザー
 */
class RejectedTemporaryUser extends Model
{
    use HasFactory;

    protected $fillable = ['reason', 'token'];

    public function temporaryUser()
    {
        return $this->belongsTo(TemporaryUser::class);
    }
}
