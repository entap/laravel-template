<?php

namespace App\Mail;

use Illuminate\Support\Arr;
use App\Models\MailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TemplateMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mail;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MailTemplate $mail, array $data)
    {
        $this->mail = $mail;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = $this->embed($this->mail->from, $this->data);
        $to = $this->embed($this->mail->to, $this->data);
        $subject = $this->embed($this->mail->subject, $this->data);
        $body = $this->embed($this->mail->body, $this->data);
        return $this->from($from)
            ->to(
                array_map(function ($address) {
                    return trim($address);
                }, explode(';', $to))
            )
            ->subject($subject)
            ->html($body);
    }

    protected function embed($text, $data): string
    {
        return preg_replace_callback(
            '/{(.*?)}/',
            function ($matches) use ($data) {
                return Arr::get($data, $matches[1]);
            },
            $text
        );
    }
}
