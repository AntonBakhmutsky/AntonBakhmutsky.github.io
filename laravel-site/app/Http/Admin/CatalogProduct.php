<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminColumnEditable;
use AdminColumnFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Http\Admin\FormElements\CategoryMultiselect;
use App\Traits\Admin\WithCodeAttribute;
use App\Traits\Admin\WithTimestamps;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Display\Column\Link;
use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Section;

/**
 * Class CatalogProduct
 *
 * @property \App\Models\CatalogProduct $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class CatalogProduct extends Section implements Initializable
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
  protected $title = 'Продукты';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('catalog')->addPage(
          (new Page($this->getClass()))->setPriority(0)->setIcon('fas fa-monument')
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    $columns = [
      AdminColumn::image('thumbnail', 'Изображение')
        ->setImageWidth(120)
        ->setOrderable(false)
        ->setFilterCallback(
          function ($column, Builder $query, ?string $search) {
            /** @var \App\Models\CatalogProduct $model */
            $model = $query->getModel();
            $relation = $model->categories();
            return $search
              ? $query
                ->join($relation->getTable(), $relation->getForeignPivotKeyName(), $model->getKeyName())
                ->where('category_id', $search)
              : $query;
          }
        ),
      AdminColumn::link('name', 'Название')
        ->setSearchCallback(
          fn(Link $column, Builder $query, string $search) => $query
            ->orWhere($column->getName(), 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%')
        )
        ->setOrderable(
          function ($query, $direction) {
            $query->orderBy('name', $direction);
          }
        ),
      AdminColumn::link('vendor_code', 'Артикул')
        ->setSearchCallback(
          fn(Link $column, Builder $query, string $search) => $query
            ->orWhere($column->getName(), 'like', '%' . $search . '%')
        )
        ->setOrderable(
          function ($query, $direction) {
            $query->orderBy('vendor_code', $direction);
          }
        ),
      AdminColumnEditable::checkbox('active')
        ->setHtmlAttribute('class', 'text-center')
        ->setLabel('Активность')
        ->setUncheckedLabel('Нет')
        ->setWidth(120)
        ->setOrderable(
          function ($query, $direction) {
            $query->orderBy('active', $direction);
          }
        ),
      AdminColumn::text('sort', 'Порядок сортировки')
        ->setHtmlAttribute('class', 'text-center')
        ->setOrderable(
          function ($query, $direction) {
            $query->orderBy('sort', $direction);
          }
        ),
    ];

    /** @var \SleepingOwl\Admin\Display\DisplayDatatables $display */
    $display = AdminDisplay::datatables()
      ->setApply(fn(Builder $query) => $query->withoutTrashed())
      ->setOrder([[3, 'asc']])
      ->setNewEntryButtonText('Новый продукт')
      ->setName('firstdatatables')
      ->setDisplaySearch(true)
      ->paginate(10)
      ->setColumns($columns)
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');

    $categories = \App\Models\CatalogCategory::active()->root()->sorted()
      ->with(['children', 'children.children', 'children.children.children'])
      ->get(['id', 'parent_id', 'name']);
    $options = \App\Models\CatalogCategory::getCategoryTree($categories);

    $display->setColumnFilters(
      [
        AdminColumnFilter::select()
          ->setWidth('400px')
          ->setOptions($options->pluck('name', 'id')->toArray())
          ->setSortable(false)
          ->setPlaceholder('Все разделы')
      ]
    );
    $display->getColumnFilters()->setPlacement('card.heading');

    return $display;
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    $attributes = [
      AdminFormElement::checkbox('active', 'Активность'),
      AdminFormElement::text('name', 'Название')
        ->required()->setValidationRules('required|string:255'),
      $this->getCodeElement($id, false),
      AdminFormElement::text('vendor_code', 'Артикул')->setValidationRules('nullable|string:255'),
      AdminFormElement::text('price', 'Цена')
          ->setValidationRules('nullable|numeric|min:0')
          ->setHtmlAttribute('class', 'col-xs-3 col-sm-2 col-md-2 col-lg-2'),
      AdminFormElement::number('sort', 'Порядок сортировки')
        ->setDefaultValue(50)
        ->required()->setValidationRules('required|integer|min:0')
        ->setHtmlAttribute('class', 'col-xs-3 col-sm-2 col-md-2 col-lg-2'),
      AdminFormElement::category_multiselect('categories', 'Категории')
        ->setLoadOptionsQueryPreparer(
          fn(CategoryMultiselect $element, Builder $query) => $query
            ->root()->sorted()
            ->with(['children', 'children.children', 'children.children.children'])
        )
        ->setSortable(false)
        ->required()
        ->setModelForOptions(\App\Models\CatalogCategory::class, 'name'),
      AdminFormElement::image('image', 'Изображение'),
      AdminFormElement::images('more_images', 'Доп. изображения'),
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
