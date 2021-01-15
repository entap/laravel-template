<?php

namespace App\Http\Controllers\Admin;

use App\Models\MailType;
use App\Models\MailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DuplicateMailTemplateController extends Controller
{
    public function __invoke(MailTemplate $mail)
    {
        $newMail = $mail->replicate(['status']);

        $typeOptions = MailType::all(['id', 'name']);
        $statusOptions = [
            ['name' => trans('mail.status.available'), 'value' => 'available'],
            [
                'name' => trans('mail.status.unavailable'),
                'value' => 'unavailable',
            ],
        ];

        return view('admin.mails.create', [
            'mail' => $newMail,
            'typeOptions' => $typeOptions,
            'statusOptions' => $statusOptions,
        ]);
    }
}
