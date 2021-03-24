<?php
namespace Entap\Admin\Application\Controllers\Auth;

use Illuminate\Http\Request;
use Entap\Admin\Facades\Admin;
use Entap\Admin\Application\Controllers\Controller;
use Entap\Admin\Database\Models\LogLoginEntry;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin::auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Admin::guard();
    }

    protected function redirectPath()
    {
        return route('admin.home');
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }

    protected function authenticated(Request $request, $user)
    {
        LogLoginEntry::create([
            'host' => $request->ip(),
            'user_id' => $user->id,
            'user_type' => 'admin',
            'user_agent' => $request->userAgent(),
        ]);
    }
}
