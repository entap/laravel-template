<?php

namespace Entap\Admin\Application\Controllers;

use Entap\Admin\Database\Models\MailType;
use Entap\Admin\Database\Models\MailTemplate;
use Entap\Admin\Application\Controllers\Controller;
use Entap\Admin\Application\Requests\SaveMailTemplateRequest;

class MailTemplateController extends Controller
{
    public function index()
    {
        $mails = MailTemplate::with('type')
            ->latest()
            ->paginate();

        // TODO タイトルの部分一致で絞り込める
        // TODO 種類で絞り込める

        return view('admin::mails.index', compact('mails'));
    }

    public function create()
    {
        $typeOptions = MailType::all(['id', 'name']);
        $statusOptions = [
            ['name' => trans('mail.status.available'), 'value' => 'available'],
            [
                'name' => trans('mail.status.unavailable'),
                'value' => 'unavailable',
            ],
        ];

        return view(
            'admin::mails.create',
            compact('typeOptions', 'statusOptions')
        );
    }

    public function store(SaveMailTemplateRequest $request)
    {
        MailTemplate::create($request->validated());

        return redirect()->route('admin.mails.index');
    }

    public function edit(MailTemplate $mail)
    {
        $typeOptions = MailType::all(['id', 'name']);
        $statusOptions = [
            ['name' => trans('mail.status.available'), 'value' => 'available'],
            [
                'name' => trans('mail.status.unavailable'),
                'value' => 'unavailable',
            ],
        ];

        return view(
            'admin::mails.edit',
            compact('mail', 'typeOptions', 'statusOptions')
        );
    }

    public function update(SaveMailTemplateRequest $request, MailTemplate $mail)
    {
        $mail->update($request->validated());

        return redirect()->route('admin.mails.index');
    }

    public function destroy(MailTemplate $mail)
    {
        $mail->delete();

        return redirect()->route('admin.mails.index');
    }
}
