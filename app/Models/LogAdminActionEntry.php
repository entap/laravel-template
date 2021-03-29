<?php

namespace App\Models;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 管理者の操作ログ
 */
class LogAdminActionEntry extends Model
{
    use HasFactory;

    protected $fillable = ['admin_user_id', 'admin_name', 'action', 'note'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }
}
