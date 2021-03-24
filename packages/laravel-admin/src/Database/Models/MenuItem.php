<?php

namespace Entap\Admin\Database\Models;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * メニュー項目
 */
class MenuItem extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $table = 'admin_menu_items';

    protected $fillable = ['title', 'uri', 'parent_id'];
}
