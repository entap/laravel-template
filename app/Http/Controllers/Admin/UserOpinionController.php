<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserOpinion;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class UserOpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opinions = UserOpinion::latest()->get();

        return view('admin.opinions.index', compact('opinions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserOpinion $opinion)
    {
        return view('admin.opinions.show', [
            'opinion' => $opinion,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserOpinion $opinion)
    {
        $opinion->delete();

        return redirect()->route('admin.opinions.index');
    }
}
