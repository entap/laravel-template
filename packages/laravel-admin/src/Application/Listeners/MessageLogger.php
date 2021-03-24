<?php

namespace Entap\Admin\Application\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Entap\Admin\Database\Models\LogSentMailEntry;

class MessageLogger
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $message = $event->message;

        LogSentMailEntry::create([
            'from' => $this->addressesToString($message->getFrom()),
            'to' => $this->addressesToString($message->getTo()),
            'subject' => $message->getSubject(),
            'body' => $message->getBody(),
        ]);
    }

    protected function addressesToString($addresses)
    {
        return collect($addresses)
            ->keys()
            ->join('; ');
    }
}
