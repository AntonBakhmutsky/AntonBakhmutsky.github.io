<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Rules\PhoneRule;
use App\Traits\Admin\WithCodeAttribute;
use App\Traits\Admin\WithTimestamps;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Display\Column\Link;
use SleepingOwl\Admin\Section;

/**
 * Class Cemetery
 *
 * @property \App\Models\Cemetery $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Cemetery extends Section implements Initializable
{
  use WithTimestamps;
  use WithCodeAttribute;

  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Кладбища';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('content')->addPage(
          (new \SleepingOwl\Admin\Navigation\Page($this->getClass()))->setPriority(40)->setIcon('fas fa-mosque')
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    $columns = [
      AdminColumn::link('name', 'Название')
        ->setSearchCallback(
          fn(Link $column, Builder $query, string $search) => $query
            ->orWhere($column->getName(), 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%')
        )
        ->setOrderable(false),
      AdminColumnEditable::checkbox('active')
        ->setHtmlAttribute('class', 'text-center')
        ->setLabel('Активность')
        ->setUncheckedLabel('Нет')
        ->setWidth(120)
        ->setOrderable(false),
      AdminColumn::order()->setLabel('Порядок сортировки')
    ];

    return AdminDisplay::datatables()
      ->setApply(fn(Builder $query) => $query->withoutTrashed()->sorted())
      ->setNewEntryButtonText('Новое кладбище')
      ->setName('firstdatatables')
      ->setDisplaySearch(true)
      ->paginate(10)
      ->setColumns($columns)
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    $phones = AdminFormElement::TextArray(
      'phones',
      [
        AdminFormElement::text('phone')->setValidationRules(['nullable', 'string:255', new PhoneRule()])
      ],
      'Телефоны'
    )->saveAsArray();
    $phones->setLoadCallback(
      function (string $value) {
        return ['phone' => $value];
      }
    );

    $coordinates = AdminFormElement::TextArray(
      'coordinates',
      [
        AdminFormElement::text('dimension')->setValidationRules(['nullable|numeric|between:-180,180'])
      ],
      'Координаты'
    )->saveAsArray()->setLimit(2);
    $coordinates->setLoadCallback(
      function (string $value) {
        return ['dimension' => $value];
      }
    );

    $attributes = [
      AdminFormElement::checkbox('active', 'Активность'),
      AdminFormElement::text('name', 'Название')
        ->required()->setValidationRules('required|string:255'),
      $this->getCodeElement($id),
      $phones,
      $coordinates,
      AdminFormElement::textarea('address', 'Адрес')->setValidationRules('nullable|string:255'),
      AdminFormElement::textarea('schedule', 'График работы'),
      AdminFormElement::wysiwyg('html', 'Описание'),
    ];

    return AdminForm::card()->addElement(
      AdminDisplay::tabbed(
        [
          AdminDisplay::tab(AdminFormElement::columns()->addColumn($this->completeAttributes($id, $attributes)), 'Свойства'),
          app('sleeping_owl')->getModel(\App\Models\MetaTag::class)->getTab()
        ]
      )
    );
  }

  public function onCreate(array $payload = []): FormInterface
  {
    return $this->onEdit(null, $payload);
  }

  public function isDeletable(Model $model): bool
  {
    return true;
  }
}
