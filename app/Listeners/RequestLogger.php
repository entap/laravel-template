<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use App\Models\Admin\LogRequestEntry;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Http\Events\RequestHandled;

class RequestLogger
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RequestHandled $event)
    {
        $this->log($event->request, $event->response);
    }

    protected function log($request, $response)
    {
        // APIのみ
        if (!$request->expectsJson()) {
            return;
        }

        return LogRequestEntry::create([
            'uuid' => Str::uuid(),
            'host' => $request->ip(),
            'method' => Str::lower($request->method()),
            'action' => $request->path(),
            'status' => $response->status(),
            'request_body' => $request->getContent(),
            'response_body' => $response->content(),
            'user_id' => optional($request->user())->id,
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
    }
}
