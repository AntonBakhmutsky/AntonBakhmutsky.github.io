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
 * Class Article
 *
 * @property \App\Models\Article $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Article extends Section implements Initializable
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
  protected $title = 'Статьи';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('content')->addPage(
          (new \SleepingOwl\Admin\Navigation\Page($this->getClass()))->setPriority(0)->setIcon('fas fa-book')
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
        ->setSearchCallback(
          fn(Link $column, Builder $query, string $search) => $query
            ->orWhere($column->getName(), 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%')
        )
        ->setOrderable(false),
      AdminColumn::datetime('active_from', 'Дата начала активности')
        ->setHtmlAttribute('class', 'text-center')
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
      ->setNewEntryButtonText('Новая статья')
      ->setName('firstdatatables')
      ->setDisplaySearch(true)
      ->paginate(10)
      ->setColumns($columns)
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    /** @var \App\Models\Article $model */
    $model = $this->getModel();
    $attributes = [
      AdminFormElement::checkbox('active', 'Активность'),
      AdminFormElement::datetime('active_from', 'Дата начала активности')->setCurrentDate(),
      AdminFormElement::datetime('active_to', 'Дата окончания активности'),
      AdminFormElement::text('name', 'Название')->required()->setValidationRules('required|string:255'),
      $this->getCodeElement($id),
      AdminFormElement::image('image', 'Изображение'),
      AdminFormElement::textarea('preview', 'Текст превью'),
      AdminFormElement::wysiwyg('html', 'Текст статьи'),
      AdminFormElement::checkbox('show_on_home', 'Показывать на главной странице'),
      AdminFormElement::select(
        'type',
        'Тип превью',
        [
          $model::PREVIEW_VERTICAL_TYPE => 'Вертикальный',
          $model::PREVIEW_HORIZONTAL_TYPE => 'Горизонтальный',
        ]
      )
        ->setDefaultValue($model::PREVIEW_VERTICAL_TYPE)->setSelect2(true)
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
