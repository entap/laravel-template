<?php

namespace App\Http\Controllers\Admin\User;

use App\Events\UserSegmentCreated;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\UserQueryRequest;
use App\Models\UserSegment;
use App\Query\Services\UserQueryService;

class UserController extends Controller
{
    private $users;

    public function __construct(UserQueryService $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    public function index(UserQueryRequest $request)
    {
        if ($request->has('saves_user_segment')) {
            return $this->saveUserSegment($request);
        }

        $users = $this->users
            ->query($request->validated())
            ->latest()
            ->paginate();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['devices']);
        return view('admin.users.show', compact('user'));
    }

    protected function saveUserSegment(UserQueryRequest $request)
    {
        $segment = UserSegment::create([
            'name' => now()->format('Y-m-d H:i'),
            'filter' => $request->except('saves_user_segment'),
        ]);

        event(new UserSegmentCreated(request()->user(), $segment));

        return redirect()->route('admin.user-segments.index');
    }
}
