<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Permission\Traits\HasRoles;

class GroupUser extends Pivot
{
    use HasRoles;

    protected $guard_name = 'web';
}
