<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMailTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mail_type_id' => 'required|exists:mail_types,id',
            'title' => 'required|string|max:20',
            'description' => 'nullable|string|max:1000',
            'from' => 'required|string|max:100',
            'to' => 'required|string|max:1000',
            'subject' => 'required|string|max:100',
            'body' => 'required|string|max:10000',
            'status' => 'required|string',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:starts_at',
        ];
    }
}
