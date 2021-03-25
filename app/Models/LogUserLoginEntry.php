<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ユーザーの認証ログ
 */
class LogUserLoginEntry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'user_email', 'auth_type'];

    /**
     * 記録する
     */
    public static function log(User $user, string $authType)
    {
        return self::create([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'auth_type' => $authType,
        ]);
    }
}
