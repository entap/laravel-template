<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\MailTemplate;
use App\Http\Controllers\Admin\Controller;

class DuplicateMailTemplateController extends Controller
{
    public function __invoke(MailTemplate $mail)
    {
        $newMail = $mail
            ->replicate()
            ->fill(['status' => MailTemplate::STATUS_AVAILABLE]);
        $newMail->save();

        return redirect()
            ->route('admin.mails.edit', $newMail)
            ->with('success', __('messages.duplicated'));
    }
}
