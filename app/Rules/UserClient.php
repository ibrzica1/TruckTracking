<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class UserClient implements ValidationRule
{
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isClient = User::where('id',$value)->where('role','client')->exists();
        if(!$isClient){
            $fail('This user is not a client');
        }
    }
}
