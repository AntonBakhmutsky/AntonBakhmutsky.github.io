<?php

namespace App\Http\Admin;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Http\Admin\Trees\StringPrimaryTreeType;
use App\Traits\Admin\WithCodeAttribute;
use App\Traits\Admin\WithTimestamps;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Section;

/**
 * Class CatalogCategory
 *
 * @property \App\Models\CatalogCategory $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class CatalogCategory extends Section implements Initializable
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
  protected $title = 'Разделы';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('catalog')->addPage(
          (new Page($this->getClass()))->setPriority(0)->setIcon('far fa-folder-open')
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    return AdminDisplay::tree(StringPrimaryTreeType::class)
      ->setApply(
        function (Builder $query) {
          $query
            ->selectRaw("*, CONCAT(CASE WHEN active <> true THEN '[x] ' END, name) as active_name")
            ->withoutTrashed();
        }
      )
      ->setMaxDepth(4)
      ->setValue('active_name')
      ->setNewEntryButtonText('Новый раздел')
      ->setOrderField('sort');
  }

  public function onEdit(?string $id = null, array $payload = []): FormInterface
  {
    /** @var \App\Models\CatalogCategory $model */
    $model = $this->getModel();
    $attributes = [
      AdminFormElement::checkbox('active', 'Активность'),
      AdminFormElement::text('name', 'Название')->required()->setValidationRules('required|string:255'),
      $this->getCodeElement($id),
      AdminFormElement::image('image', 'Изображение'),
      AdminFormElement::textarea('preview', 'Текст превью'),
      AdminFormElement::wysiwyg('html', 'Описание'),
      AdminFormElement::select(
        'text_position',
        'Положение текста',
        [
          $model::TEXT_TOP_POSITION => 'Сверху',
          $model::TEXT_BOTTOM_POSITION => 'Снизу',
        ]
      )
        ->setDefaultValue($model::TEXT_TOP_POSITION)->setSelect2(true)
        ->setHtmlAttribute('class', 'col-xs-3 col-sm-2 col-md-2 col-lg-2'),
      AdminFormElement::select(
        'type',
        'Тип',
        [
          $model::TYPE_TABBED => 'С табами',
          $model::TYPE_VERTICAL => 'Вертикальный',
          $model::TYPE_HORIZONTAL => 'Горизонтальный',
        ]
      )
        ->setDefaultValue($model::TYPE_HORIZONTAL)->setSelect2(true)
        ->setHtmlAttribute('class', 'col-xs-3 col-sm-2 col-md-2 col-lg-2'),
      AdminFormElement::checkbox('show_on_home', 'Показывать на главной странице'),
      AdminFormElement::number('page_size', 'Количество продуктов на странице')
        ->required()->setValidationRules('required|integer|min:1')
        ->setDefaultValue(12)
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
