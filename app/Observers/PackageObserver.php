<?php

namespace App\Observers;

use App\Models\Package;

class PackageObserver
{
    public function deleting(Package $package)
    {
        $package->releases()->delete();
    }
}
