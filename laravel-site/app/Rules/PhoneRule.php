<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Str;

class PhoneRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
      $phone = preg_replace('/[^\d]/', '', $value);
      return Str::length($phone) === 11;
    }

    public function message(): string
    {
        return __('validation.phone');
    }
}
