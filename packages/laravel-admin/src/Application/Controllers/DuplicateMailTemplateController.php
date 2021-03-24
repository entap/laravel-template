<?php

namespace Entap\Admin\Application\Controllers;

use Illuminate\Http\Request;
use Entap\Admin\Database\Models\MailTemplate;
use Entap\Admin\Application\Controllers\Controller;

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
            ->with('success', __('admin::messages.duplicated'));
    }
}
