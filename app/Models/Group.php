<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * グループ
 */
class Group extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = ['name'];

    public function members()
    {
        return $this->hasMany(GroupMember::class);
    }

    /**
     * ユーザーをメンバーに加える
     */
    public function assignUser(int $userId)
    {
        return $this->members()->create([
            'user_id' => $userId,
        ]);
    }

    /**
     * ユーザーがメンバーに入っているかどうか
     */
    public function hasUser($userId)
    {
        return $this->members->contains('user_id', $userId);
    }
}
