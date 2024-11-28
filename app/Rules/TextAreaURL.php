<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TextAreaURL implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $URLs = preg_split("/\r\n|\n|\r/", $value);

        foreach ($URLs as $URL) {
            if (!filter_var($URL, FILTER_VALIDATE_URL)) {
                $fail($attribute, 'The ' . $attribute . ' must be a valid URL.');
            }
        }
    }
}
