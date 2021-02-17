<?php

namespace App\Http\Controllers;

use App\Models\UserSegment;
use Illuminate\Http\Request;

class UserSegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userSegments = UserSegment::latest()->paginate();

        return view('admin.user_segments.index', compact('userSegments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserSegment $userSegment)
    {
        return redirect()->route('admin.users.index', $userSegment->filter);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        return redirect()->route('admin.user-segments.index');
    }
}
