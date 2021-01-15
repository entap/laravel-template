<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
use App\Models\MailType;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mail_type_id' => 'required|exists:mail_types,id',
            'title' => 'required|string|max:20',
            'description' => 'nullable|string|max:1000',
            'from' => 'required|string|max:100',
            'to' => 'required|string|max:1000',
            'subject' => 'required|string|max:100',
            'body' => 'required|string|max:10000',
            'status' => 'required|string',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
        ]);

        MailTemplate::create($validatedData);

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

    public function update(Request $request, MailTemplate $mail)
    {
        $validatedData = $request->validate([
            'mail_type_id' => 'required|exists:mail_types,id',
            'title' => 'required|string|max:20',
            'description' => 'nullable|string|max:1000',
            'from' => 'required|string|max:100',
            'to' => 'required|string|max:1000',
            'subject' => 'required|string|max:100',
            'body' => 'required|string|max:10000',
            'status' => 'required|string',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
        ]);

        $mail->update($validatedData);

        return redirect()->route('admin.mails.index');
    }

    public function destroy(MailTemplate $mail)
    {
        $mail->delete();

        return redirect()->route('admin.mails.index');
    }
}
