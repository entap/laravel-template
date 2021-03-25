<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Permission
{
    public function roles(): BelongsToMany;

    public static function findByName(string $name): ?Permission;
}
