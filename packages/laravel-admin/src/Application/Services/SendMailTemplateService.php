<?php
namespace Entap\Admin\Application\Services;

use InvalidArgumentException;
use Illuminate\Support\Facades\Mail;
use Entap\Admin\Database\Models\MailType;
use Entap\Admin\Database\Models\MailTemplate;
use Entap\Admin\Application\Mail\TemplateMail;

class SendMailTemplateService
{
    /**
     * メールのテンプレートをもとに送信する
     */
    public function send(MailTemplate $mail, array $embeddedData = []): void
    {
        if ($mail->isAvailable()) {
            return;
        }
        Mail::send(new TemplateMail($mail, $embeddedData));
    }

    /**
     * メールのテンプレートIDをもとに送信する
     */
    public function sendById(int $mailId, array $embeddedData = []): void
    {
        $mail = MailTemplate::find($mailId);
        if (empty($mail)) {
            throw new InvalidArgumentException('Mail template is not found.');
        }

        $this->send($mail, $embeddedData);
    }

    /**
     * メールの種類IDをもとに送信する
     */
    public function sendByType(int $mailTypeId, array $embeddedData = []): void
    {
        $mails = MailTemplate::typed($mailTypeId)->get();

        foreach ($mails as $mail) {
            $this->send($mail, $embeddedData);
        }
    }

    /**
     * メールの種類コードをもとに送信する
     */
    public function sendByTypeCode(string $code, array $embeddedData = []): void
    {
        $type = MailType::ofCode($code)->first();
        if (empty($type)) {
            throw new InvalidArgumentException('Mail type is not found.');
        }

        $this->sendByType($type->id, $embeddedData);
    }
}
