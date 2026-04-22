<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UserDriver implements ValidationRule
{
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isDriver = User::where('id',$value)->where('role','driver')->exists();

        if(!$isDriver){
            $fail('This user is not a driver');
        }
    }
}
