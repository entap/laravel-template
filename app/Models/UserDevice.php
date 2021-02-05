<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 使用する端末
 */
class UserDevice extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'platform', 'screen_width', 'screen_height'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
