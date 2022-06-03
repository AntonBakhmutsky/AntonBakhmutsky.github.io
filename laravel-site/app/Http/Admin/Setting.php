<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Section;
use Str;

/**
 * Class Setting
 *
 * @property \App\Models\Setting $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Setting extends Section implements Initializable
{
  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Настройки';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('system')->addPage(
          (new Page($this->getClass()))->setPriority(0)->setIcon('fas fa-cog')
        );
      }
    );
  }

  /**
   * @param array $payload
   *
   * @return DisplayInterface
   */
  public function onDisplay(array $payload = []): DisplayInterface
  {
    $columns = [
      AdminColumn::text('code', 'Символьный код')
        ->setWidth('30%')
        ->setSearchable(true),
      AdminColumn::custom(
        'Значение',
        function (\App\Models\Setting $setting) {
          return htmlspecialchars(Str::limit($setting->value), 120);
        }
      )->setOrderable(false)->setSearchable(true)
    ];

    return AdminDisplay::datatables()
      ->setApply(fn(Builder $query) => $query->withoutTrashed())
      ->setName('firstdatatables')
      ->setOrder([[0, 'asc']])
      ->setDisplaySearch(true)
      ->paginate(25)
      ->setColumns($columns)
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    $attributes = [AdminFormElement::text('code', 'Символьный код')->required()->setReadonly(true)];

    switch ($this->getModelValue()->type) {
      case \App\Models\Setting::TYPE_STRING:
        $attributes[] = AdminFormElement::text('value', 'Значение')->setValidationRules('nullable|string:255');
        break;
      case \App\Models\Setting::TYPE_TEXT:
        $attributes[] = AdminFormElement::textarea('value', 'Значение')->setValidationRules('nullable');
        break;
      case \App\Models\Setting::TYPE_BOOL:
        $attributes = AdminFormElement::checkbox('value', $this->getModelValue()->code);
        break;
    }

    $form = AdminForm::card()->addBody($attributes);

    $form->getButtons()->setButtons(
      [
        'save' => new Save(),
        'save_and_close' => new SaveAndClose(),
        'cancel' => (new Cancel()),
      ]
    );

    return $form;
  }

  public function isDeletable(Model $model): bool
  {
    return false;
  }

  public function isCreatable(): bool
  {
    return false;
  }
}
