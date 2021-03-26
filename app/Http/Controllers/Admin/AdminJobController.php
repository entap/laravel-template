<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class AdminJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $jobs = AdminJob::where('admin_user_id', $user->id)->paginate(5);

        return view('admin.jobs.index', compact('jobs'));
    }
}
