<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;

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

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $message = $event->message;
        $data = [
            'from' => $message->getFrom(),
            'to' => $message->getTo(),
            'subject' => $message->getSubject(),
            'body' => $message->getBody(),
        ];
        // TODO データベースに突っ込む？
        logger()->debug('E-mail is sent.', $data);
    }
}
