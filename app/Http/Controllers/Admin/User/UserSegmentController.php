<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\UserSegment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Admin\Controller;

class UserSegmentController extends Controller
{
    public function index()
    {
        $userSegments = UserSegment::latest()->paginate();

        return view('admin.user_segments.index', compact('userSegments'));
    }

    public function show(UserSegment $userSegment)
    {
        return redirect()->route('admin.users.index', $userSegment->filter);
    }

    public function edit(UserSegment $userSegment)
    {
        return view('admin.user_segments.edit', compact('userSegment'));
    }

    public function update(Request $request, UserSegment $userSegment)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('user_segments')->ignore($userSegment),
            ],
        ]);
        $userSegment->update($data);

        return redirect()->route('admin.user-segments.index');
    }

    public function destroy(UserSegment $userSegment)
    {
        $userSegment->delete();

        return redirect()->route('admin.user-segments.index');
    }
}
