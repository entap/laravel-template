<?php
namespace App\Services;

use App\Models\MailTemplate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class SendMailTemplateService
{
    public function send(MailTemplate $mail, array $embeddedData)
    {
        $from = $this->embed($mail->from, $embeddedData);
        $subject = $this->embed($mail->subject, $embeddedData);
        $body = $this->embed($mail->body, $embeddedData);
        $destinations = explode(';', $this->embed($mail->to, $embeddedData));

        foreach ($destinations as $to) {
            Mail::send([], [], function ($message) use (
                $from,
                $to,
                $subject,
                $body
            ) {
                return $message
                    ->from($from)
                    ->to($to)
                    ->subject($subject)
                    ->setBody($body);
            });
        }
    }

    protected function embed($text, $data): string
    {
        return preg_replace_callback(
            '/{(.*?)}',
            function ($matches) use ($data) {
                return Arr::get($data, $matches[1]);
            },
            $text
        );
    }
}
