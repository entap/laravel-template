<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserQueryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'nullable|integer',
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'start_created_at' => 'nullable|date',
            'end_created_at' => 'nullable|date',
        ];
    }
}
