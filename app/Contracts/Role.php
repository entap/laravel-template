<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface Role
{
    public function permissions(): BelongsToMany;

    public static function findByName(string $name): ?Role;
}
