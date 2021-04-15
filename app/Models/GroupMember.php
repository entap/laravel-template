<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

/**
 * グループメンバー
 */
class GroupMember extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = ['user_id'];

    protected $guard_name = 'web';

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }
}
