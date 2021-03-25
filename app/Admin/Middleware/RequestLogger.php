<?php
namespace App\Admin\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\LogRequestEntry;

class RequestLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        LogRequestEntry::create([
            'uuid' => Str::uuid(),
            'host' => $request->ip(),
            'method' => Str::lower($request->method()),
            'action' => $request->path(),
            'status' => $response->status(),
            'request_body' => $request->getContent(),
            'response_body' => $response->content(),
            'user_id' => $request->user() ? $request->user()->id : null,
            'device' => $request->header(config('admin.custom.headers.device')),
            'device_brand' => $request->header(
                config('admin.custom.headers.device_brand')
            ),
            'platform' => $request->header(
                config('admin.custom.headers.platform')
            ),
            'platform_version' => $request->header(
                config('admin.custom.headers.platform_version')
            ),
            'package_name' => $request->header(
                config('admin.custom.headers.package_name')
            ),
            'package_version' => $request->header(
                config('admin.custom.headers.package_version')
            ),
        ]);

        return $response;
    }
}
