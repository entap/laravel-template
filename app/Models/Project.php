<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * プロジェクト
 */
class Project extends Model implements GroupOwnership
{
    use HasFactory;
    use HasOwnerGroup;

    protected $fillable = ['name'];
}
