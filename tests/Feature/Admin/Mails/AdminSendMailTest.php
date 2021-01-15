<?php

namespace Tests\Feature\Admin\Mails;

use App\Mail\TemplateMail;
use App\Models\MailTemplate;
use Tests\TestCase;
use App\Services\SendMailTemplateService;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

/**
 * 管理者として、メールを送信できる
 * @group mails
 */
class AdminSendMailTest extends TestCase
{
    public function test_メールを送る()
    {
        Mail::fake();

        $mail = MailTemplate::factory()->create();

        $s = new SendMailTemplateService();
        $s->sendById($mail->id);

        Mail::assertSent(TemplateMail::class);
    }

    public function test_テキストを埋め込める()
    {
        Mail::fake();

        $mail = MailTemplate::factory()->create([
            'from' => '{from}',
            'to' => '{user.email}',
            'subject' => 'Hi, {user.name}',
            'body' => 'Hello. {user.name}.',
        ]);

        $s = new SendMailTemplateService();
        $s->sendById($mail->id, [
            'from' => 'from@example.com',
            'user' => [
                'name' => 'Masamitsu',
                'email' => 'test@example.com',
            ],
        ]);

        Mail::assertSent(TemplateMail::class, function ($mail) {
            $mail->build();
            return $mail->hasTo('test@example.com') &&
                $mail->hasFrom('from@example.com');
        });
    }
}
