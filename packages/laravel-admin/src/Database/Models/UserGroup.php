<?php

namespace Entap\Admin\Database\Models;

use Entap\Admin\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * 管理グループ
 */
class UserGroup extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $table = 'admin_user_groups';

    protected $fillable = ['name', 'parent_id'];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'admin_user_group_user',
            'group_id',
            'user_id'
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($group) {
            $group->users()->detach();
        });
    }
}
