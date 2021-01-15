<?php
namespace App\Services;

use App\Mail\TemplateMail;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

class SendMailTemplateService
{
    public function send(int $mailId, array $embeddedData = [])
    {
        $mail = MailTemplate::find($mailId);
        if (empty($mail)) {
            throw new InvalidArgumentException('Mail template is not found.');
        }

        Mail::send(new TemplateMail($mail, $embeddedData));
    }
}
