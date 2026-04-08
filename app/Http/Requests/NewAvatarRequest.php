<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NewAvatarRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:4096'
        ];
    }
}
