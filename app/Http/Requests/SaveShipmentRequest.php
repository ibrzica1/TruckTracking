<?php

namespace App\Http\Requests;

use App\Rules\UserClient;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveShipmentRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',

            'from_city' => 'required|string|max:255',
            'from_country' => 'required|string|max:255',

            'to_city' => 'required|string|max:255',
            'to_country' => 'required|string|max:255',

            'price' => 'required|numeric|min:0',
            'user_id' => [
                'required',
                'numeric',
                new UserClient()
            ],

            'status' => 'required|in:in_progress,unnasigned,completed,problem',

            'details' => 'nullable|string',

            'documents' => 'required|array',

            'document.*' => 'file|mimes:jpg,jpeg,png,webp,pdf,doc,docx|max:10240'
        ];
    }
}
