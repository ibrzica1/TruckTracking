<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShipmentRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',

            'from_city' => 'required|string|max:255',
            'from_country' => 'required|string|max:255',

            'to_city' => 'required|string|max:255',
            'to_country' => 'required|string|max:255',
            'user_id' => [
                'required',
                'numeric',
                Rule::exists('users','id')->where(function($query){
                    $query->where('role',User::DRIVER);
                }),
            ],

            'price' => 'required|numeric|min:0',

            'status' => 'required|in:in_progress,unnasigned,completed,problem',

            'details' => 'nullable|string',
        ];
    }
}
