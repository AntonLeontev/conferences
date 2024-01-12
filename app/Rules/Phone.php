<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Phone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $clean = strlen(preg_replace('~\D~', '', $value));

        if ($clean < 11 || $clean > 11) {
            $fail(__('validation.phone.digits'));
        }
    }
}
