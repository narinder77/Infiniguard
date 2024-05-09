<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmailInJson implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        dd($value);
    }
    public function passes($attribute, $value)
    {
        dd($value);
        // Ensure that the emails in the array are unique
        return count($value) === count(array_unique($value));
    }

    public function message()
    {
        return 'Emails must be unique.';
    }
}
