<?php
namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageReleaseController extends Controller
{
    public function index(Package $package)
    {
        $availableReleases = $package
            ->releases()
            ->available()
            ->get();

        return [
            'data' => $availableReleases,
        ];
    }
}
