<?php

namespace App\Http\Requests;

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

            'status' => 'required|in:pending,confirmed,cancelled',

            'user_id' => 'required|exists:users,id',

            'details' => 'nullable|string',
        ];
    }
}
