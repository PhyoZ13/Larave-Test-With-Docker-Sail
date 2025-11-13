<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if alphanumeric only
        if (!preg_match('/^[a-zA-Z0-9]+$/', $value)) {
            $fail('パスワードは英数字のみで入力してください');
            return;
        }

        // Check if contains uppercase letter
        if (!preg_match('/[A-Z]/', $value)) {
            $fail('パスワードは大文字、小文字、数字を必ず入れてください');
            return;
        }

        // Check if contains lowercase letter
        if (!preg_match('/[a-z]/', $value)) {
            $fail('パスワードは大文字、小文字、数字を必ず入れてください');
            return;
        }

        // Check if contains number
        if (!preg_match('/[0-9]/', $value)) {
            $fail('パスワードは大文字、小文字、数字を必ず入れてください');
            return;
        }
    }
}
