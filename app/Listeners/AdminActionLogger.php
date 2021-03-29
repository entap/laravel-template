<?php

namespace App\Listeners;

use App\Models\LogAdminActionEntry;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminActionLogger
{
    protected $events = [
        \App\Events\Admin\AdminCreated::class,
        \App\Events\Admin\AdminDeleted::class,
        \App\Events\Admin\AdminGroupCreated::class,
        \App\Events\Admin\AdminGroupDeleted::class,
        \App\Events\Admin\AdminGroupUpdated::class,
        \App\Events\Admin\AdminUpdated::class,
        \App\Events\Admin\DynamicCategoryCreated::class,
        \App\Events\Admin\DynamicCategoryDeleted::class,
        \App\Events\Admin\DynamicCategoryUpdated::class,
        \App\Events\Admin\DynamicPageCreated::class,
        \App\Events\Admin\DynamicPageDeleted::class,
        \App\Events\Admin\DynamicPageUpdated::class,
        \App\Events\Admin\MailCreated::class,
        \App\Events\Admin\MailDeleted::class,
        \App\Events\Admin\MailUpdated::class,
        \App\Events\Admin\MenuUpdated::class,
        \App\Events\Admin\RoleCreated::class,
        \App\Events\Admin\RoleDeleted::class,
        \App\Events\Admin\RoleUpdated::class,
        \App\Events\AgreementTypeCreated::class,
        \App\Events\AgreementTypeDeleted::class,
        \App\Events\AgreementTypeUpdated::class,
        \App\Events\PackageCreated::class,
        \App\Events\PackageDeleted::class,
        \App\Events\PackageUpdated::class,
        \App\Events\ReleaseCreated::class,
        \App\Events\ReleaseDeleted::class,
        \App\Events\ReleaseUpdated::class,
        \App\Events\UserAccepted::class,
        \App\Events\UserRejected::class,
        \App\Events\UserSegmentCreated::class,
        \App\Events\UserSegmentDeleted::class,
        \App\Events\UserSegmentUpdated::class,
        \App\Events\UserSuspended::class,
        \App\Events\UserUnsuspended::class,
    ];

    public function subscribe(Dispatcher $events)
    {
        $events->listen($this->events, [self::class, 'log']);
    }

    public function log($event)
    {
        LogAdminActionEntry::create([
            'admin_user_id' => $event->actor->id,
            'admin_name' => $event->actor->name,
            'action' => get_class($event),
        ]);
    }
}
