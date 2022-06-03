<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;
use Settings;

class ReCaptchaRule implements Rule
{
  /**
   * Determine if the validation rule passes.
   *
   * @param string $attribute
   * @param mixed $value
   *
   * @return bool
   */
  public function passes($attribute, $value): bool
  {
    $recaptcha = new ReCaptcha(Settings::get('google_recaptcha_secret'));
    $response = $recaptcha->setExpectedHostname(request()->getHost())
      ->setScoreThreshold(0.5)
      ->verify($value, request()->ip());

    return $response->isSuccess();
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message(): string
  {
    return __('validation.recaptcha');
  }
}
