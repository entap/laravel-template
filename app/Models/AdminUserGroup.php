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
