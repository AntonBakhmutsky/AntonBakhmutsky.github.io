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
use Illuminate\Validation\Rule;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Display\Column\Link;
use SleepingOwl\Admin\Section;

/**
 * Class Page
 *
 * @property \App\Models\Page $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Page extends Section implements Initializable
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
  protected $title = 'Страницы';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('content')->addPage(
          (new \SleepingOwl\Admin\Navigation\Page($this->getClass()))->setPriority(0)->setIcon('far fa-newspaper')
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    $columns = [
      AdminColumn::link('name', 'Название')->setSearchCallback(
        fn(Link $column, Builder $query, string $search) => $query
          ->orWhere($column->getName(), 'like', '%' . $search . '%')
          ->orWhere('code', 'like', '%' . $search . '%')
          ->orWhere('url', 'like', '%' . $search . '%')
      )
        ->setOrderable(
          function ($query, $direction) {
            $query->orderBy('name', $direction);
          }
        ),
      AdminColumnEditable::checkbox('active')
        ->setHtmlAttribute('class', 'text-center')
        ->setLabel('Активность')
        ->setUncheckedLabel('Нет')
        ->setWidth(120)
        ->setOrderable(
          function (Builder $query, string $direction) {
            $query->orderBy('active', $direction);
          },
        ),
      AdminColumn::text('code', 'Символьный код')->setOrderable(false),
      AdminColumn::text('url', 'URL')->setOrderable(false)
    ];

    return AdminDisplay::datatables()
      ->setApply(fn(Builder $query) => $query->withoutTrashed())
      ->setName('firstdatatables')
      ->setOrder([[0, 'asc']])
      ->setDisplaySearch(true)
      ->paginate(10)
      ->setColumns($columns)
      ->setNewEntryButtonText('Новая страница')
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    $uniqueUrlRule = Rule::unique($this->getModel()->getTable(), 'url')->whereNull('deleted_at');
    $urlRules = [
      'nullable',
      'string:255',
      ! is_null($id) ? $uniqueUrlRule->ignore($id) : $uniqueUrlRule
    ];

    $attributes = [
      AdminFormElement::checkbox('active', 'Активность'),
      AdminFormElement::text('name', 'Название')->required()->setValidationRules('required|string:255'),
      $this->getCodeElement($id, false),
      AdminFormElement::text('url', 'URL')->setValidationRules($urlRules),
      AdminFormElement::wysiwyg('html', 'Текст'),
      AdminFormElement::select(
        'text_position',
        'Положение текста',
        [
          $this->getModel()::TEXT_TOP_POSITION => 'Сверху',
          $this->getModel()::TEXT_BOTTOM_POSITION => 'Снизу',
        ]
      )
        ->setDefaultValue($this->getModel()::TEXT_BOTTOM_POSITION)->setSelect2(true)
        ->setHtmlAttribute('class', 'col-xs-3 col-sm-2 col-md-2 col-lg-2'),
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
