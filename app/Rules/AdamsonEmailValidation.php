<?php

namespace App\Rules\AdamsonEmailValidation;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class AdamsonEmailValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }

    public function passes($attribute, $value)
    {
        $domainPart = explode('@', $value)[1] ?? null;

        if (!$domainPart) {
            return false;
        }

        return $domainPart === 'adamson.edu.ph';
    
    }
    public function message()
{
    return 'The :attribute must be a adamson.edu.ph address';
}


}