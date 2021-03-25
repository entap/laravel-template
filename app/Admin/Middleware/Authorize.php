<?php
namespace App\Admin\Middleware;

use Closure;
use App\Facades\Admin;
use App\Models\Admin\User;

class Authorize
{
    public function handle($request, Closure $next)
    {
        if (Admin::guard()->guest()) {
            // 認証はAuthenticateに任せて、ゲストは素通し
            return $next($request);
        }

        if ($this->shouldPassThrough(Admin::user(), $request)) {
            return $next($request);
        }

        abort(403, '許可されていないリクエストです。');
    }

    private function shouldPassThrough(User $user, $request): bool
    {
        if ($user->isAdministrator()) {
            // スーパーユーザーは常に通す
            return true;
        }

        return $user->hasOperation($request->method(), $request->decodedPath());
    }
}
