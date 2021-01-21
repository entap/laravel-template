<?php

namespace App\Models;

use Entap\Admin\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class AdminUserGroup extends Model
{
    use HasFactory;
    use NodeTrait;

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'admin_user_group_user',
            'group_id',
            'user_id'
        );
    }
}
