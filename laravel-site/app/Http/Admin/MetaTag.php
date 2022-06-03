<?php


namespace App\Http\Admin;


use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Display\DisplayTab;
use SleepingOwl\Admin\Section;

class MetaTag extends Section implements Initializable
{
  public function initialize()
  {
  }

  public function getTab(): DisplayTab
  {
    return AdminDisplay::tab(
      AdminFormElement::columns()->addColumn(
        [
          AdminFormElement::hasMany('meta', $this->getFormElements())->setLimit(1),
        ]
      ), 'Мета'
    );
  }

  private function getFormElements(): array
  {
    return [
      AdminFormElement::text('title', 'Заголовок')->setValidationRules('nullable|string:255'),
      AdminFormElement::text('h1', 'H1')->setValidationRules('nullable|string:255'),
      AdminFormElement::text('keywords', 'Ключевые слова')->setValidationRules('nullable|string:255'),
      AdminFormElement::textarea('description', 'Описание'),
      AdminFormElement::image('image', 'Изображение')
    ];
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    return AdminForm::form($this->getFormElements());
  }

  public function onCreate($payload = []): FormInterface
  {
    return $this->onEdit(null, $payload);
  }
}
