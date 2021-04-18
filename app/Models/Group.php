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

    protected $fillable = ['parent_id', 'name'];

    public function members()
    {
        return $this->hasMany(GroupMember::class);
    }

    /**
     * ユーザーをメンバーに加える
     */
    public function assignUser(int $userId)
    {
        // TODO 名前がイマイチかも
        // TODO すでに存在する場合はエラー
        return $this->members()->create([
            'user_id' => $userId,
        ]);
    }

    /**
     * ユーザーがメンバーに入っているかどうか
     */
    public function hasUser(int $userId)
    {
        return $this->members->contains('user_id', $userId);
    }

    /**
     * ユーザーからメンバーを取得する
     */
    public function getUser(int $userId)
    {
        return $this->members->firstWhere('user_id', $userId);
    }
}
