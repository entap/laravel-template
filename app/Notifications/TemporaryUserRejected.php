<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\RejectedTemporaryUser;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TemporaryUserRejected extends Notification
{
    use Queueable;

    protected $rejectedTemporaryUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RejectedTemporaryUser $rejectedTemporaryUser)
    {
        $this->rejectedTemporaryUser = $rejectedTemporaryUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // FIXME 理由などをつける
        return (new MailMessage())->action(
            __('Fix Your Profile'),
            route('temporary-users.edit', $this->rejectedTemporaryUser)
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
                //
            ];
    }
}
