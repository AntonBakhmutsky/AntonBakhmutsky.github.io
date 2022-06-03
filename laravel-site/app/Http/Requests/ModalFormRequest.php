<?php

namespace App\Http\Requests;

use App\Models\Request;
use App\Rules\PhoneRule;
use App\Rules\ReCaptchaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModalFormRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string:255|regex:/^[\pL\s\-]+$/u',
      'product_id' => 'nullable|uuid|exists:App\Models\CatalogProduct,id,deleted_at,NULL',
      'phone' => ['required', new PhoneRule()],
      'type' => ['required', Rule::in([Request::TYPE_CALL, Request::TYPE_CONSULTATION, Request::TYPE_ORDER])],
    ];
  }
}
