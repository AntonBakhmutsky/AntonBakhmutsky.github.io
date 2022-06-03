<?php


namespace App\Traits\Admin;


use AdminFormElement;
use Illuminate\Validation\Rule;
use SleepingOwl\Admin\Form\Element\Text;

trait WithCodeAttribute
{
  /**
   * @param int|string|null $id
   * @param bool $isRequired
   *
   * @return \SleepingOwl\Admin\Form\Element\Text
   */
  public function getCodeElement(int|string|null $id, bool $isRequired = true): Text
  {
    $code = AdminFormElement::text('code', 'Символьный код');
    $uniqueRule = Rule::unique($this->getModel()->getTable(), 'code')->whereNull('deleted_at');
    $rules = [
      'string:255',
      'alpha_dash',
      ! is_null($id) ? $uniqueRule->ignore($id) : $uniqueRule
    ];
    return is_null($id) || ! $isRequired
      ? $code->setValidationRules(array_merge($rules, ['nullable']))
      : $code->required()->setValidationRules(array_merge($rules, ['required']));
  }
}
