<?php
namespace App\Services;

use App\Mail\TemplateMail;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

class SendMailTemplateService
{
    public function send(MailTemplate $mail, array $embeddedData = []): void
    {
        if ($mail->isAvailable()) {
            return;
        }
        Mail::send(new TemplateMail($mail, $embeddedData));
    }

    public function sendById(int $mailId, array $embeddedData = []): void
    {
        $mail = MailTemplate::find($mailId);
        if (empty($mail)) {
            throw new InvalidArgumentException('Mail template is not found.');
        }

        $this->send($mail, $embeddedData);
    }

    public function sendByType(int $mailTypeId, array $embeddedData = []): void
    {
        $mails = MailTemplate::typed($mailTypeId)->get();

        foreach ($mails as $mail) {
            $this->send($mail, $embeddedData);
        }
    }
}
