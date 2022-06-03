<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
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
 * Class Promotion
 *
 * @property \App\Models\Promotion $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Promotion extends Section implements Initializable
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
  protected $title = 'Акции';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('content')->addPage(
          (new \SleepingOwl\Admin\Navigation\Page($this->getClass()))->setPriority(0)->setIcon('fas fa-percentage')
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    $columns = [
      AdminColumn::image('thumbnail', 'Изображение')
        ->setImageWidth(120)
        ->setOrderable(false),
      AdminColumn::link('name', 'Название')
        ->setOrderable(false)
        ->setSearchCallback(
          fn(Link $column, Builder $query, string $search) => $query
            ->orWhere($column->getName(), 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%')
        ),
      AdminColumn::datetime('date_from', 'Дата начала')
        ->setOrderable(false)
        ->setHtmlAttribute('class', 'text-center'),
      AdminColumnEditable::checkbox('active')
        ->setOrderable(false)
        ->setHtmlAttribute('class', 'text-center')
        ->setLabel('Активность')
        ->setUncheckedLabel('Нет')
        ->setWidth(120),
      AdminColumn::order()->setLabel('Порядок сортировки')
    ];

    return AdminDisplay::datatables()
      ->setApply(fn(Builder $query) => $query->withoutTrashed()->sorted())
      ->setNewEntryButtonText('Новая акция')
      ->setName('firstdatatables')
      ->setDisplaySearch(true)
      ->paginate(10)
      ->setColumns($columns)
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    $attributes = [
      AdminFormElement::checkbox('active', 'Активность'),
      AdminFormElement::datetime('date_from', 'Дата начала'),
      AdminFormElement::datetime('date_to', 'Дата окончания'),
      AdminFormElement::text('name', 'Название')->required()->setValidationRules('required|string:255'),
      $this->getCodeElement($id),
      AdminFormElement::image('image', 'Изображение'),
      AdminFormElement::textarea('preview', 'Текст превью'),
      AdminFormElement::wysiwyg('html', 'Описание'),
      AdminFormElement::checkbox('show_on_home', 'Показывать на главной странице'),
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
