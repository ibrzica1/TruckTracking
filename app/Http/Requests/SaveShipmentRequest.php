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

            'fromCity' => 'required|string|max:255',
            'fromCountry' => 'required|string|max:255',

            'toCity' => 'required|string|max:255',
            'toCountry' => 'required|string|max:255',

            'price' => 'required|numeric|min:0',
            'clientId' => [
                'required',
                'numeric',
                new UserClient()
            ],

            'status' => 'required|in:in_progress,unnasigned,completed,problem',

            'details' => 'nullable|string',

            'documents' => 'required|array',

            'documents.*' => 'file|mimes:jpg,jpeg,png,webp,pdf,doc,docx|max:10240'
        ];
    }
}
