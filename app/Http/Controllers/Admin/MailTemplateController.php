<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\MailType;
use App\Events\Admin\MailCreated;
use App\Events\Admin\MailDeleted;
use App\Events\Admin\MailUpdated;
use App\Models\Admin\MailTemplate;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\SaveMailTemplateRequest;

class MailTemplateController extends Controller
{
    public function index()
    {
        $mails = MailTemplate::with('type')
            ->latest()
            ->paginate();

        // TODO タイトルの部分一致で絞り込める
        // TODO 種類で絞り込める

        return view('admin.mails.index', compact('mails'));
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
            'admin.mails.create',
            compact('typeOptions', 'statusOptions')
        );
    }

    public function store(SaveMailTemplateRequest $request)
    {
        $mail = MailTemplate::create($request->validated());

        event(new MailCreated(request()->user(), $mail));

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
            'admin.mails.edit',
            compact('mail', 'typeOptions', 'statusOptions')
        );
    }

    public function update(SaveMailTemplateRequest $request, MailTemplate $mail)
    {
        $mail->update($request->validated());

        event(new MailUpdated(request()->user(), $mail));

        return redirect()->route('admin.mails.index');
    }

    public function destroy(MailTemplate $mail)
    {
        $mail->delete();

        event(new MailDeleted(request()->user(), $mail));

        return redirect()->route('admin.mails.index');
    }
}
