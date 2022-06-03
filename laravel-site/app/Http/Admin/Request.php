<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Traits\Admin\WithTimestamps;
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

/**
 * Class Request
 *
 * @property \App\Models\Request $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class Request extends Section implements Initializable
{
  use WithTimestamps;

  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Заявки';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('feedback')->addPage(
          (new Page($this->getClass()))->setPriority(0)->setIcon('fas fa-comments-dollar')
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    $columns = [
      AdminColumn::link('name', 'ФИО')
        ->setSearchable(true)
        ->setOrderable(false),
      AdminColumn::link('phone', 'Телефон')
        ->setSearchable(true)
        ->setOrderable(false),
      AdminColumn::datetime('created_at', 'Время создания')
        ->setHtmlAttribute('class', 'text-center')
        ->setSearchable(false)
        ->setOrderable(
          function (Builder $query, string $direction) {
            $query->orderBy('created_at', $direction);
          },
        ),
      AdminColumn::text('status', 'Статус')
        ->setHtmlAttribute('class', 'text-center')
        ->setSearchable(false)
        ->setOrderable(
          function (Builder $query, string $direction) {
            $query->orderBy('status', $direction);
          },
        ),
    ];

    return AdminDisplay::datatables()
      ->setApply(fn(Builder $query) => $query->withoutTrashed())
      ->setName('firstdatatables')
      ->setOrder([[2, 'asc']])
      ->setDisplaySearch(true)
      ->paginate(20)
      ->setColumns($columns)
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');
  }

  public function onEdit(?int $id = null, array $payload = []): FormInterface
  {
    $attributes = [
      AdminFormElement::select(
        'status',
        'Статус',
        [
          $this->getModel()::STATUS_NEW => 'Новая',
          $this->getModel()::STATUS_CLOSED => 'Закрыта',
          $this->getModel()::STATUS_CANCELED => 'Отменена',
        ]
      )
        ->setSelect2(true)
        ->setHtmlAttribute('class', 'col-xs-3 col-sm-2 col-md-2 col-lg-2'),
      AdminFormElement::text('name', 'ФИО')->setReadonly(true),
      AdminFormElement::text('phone', 'Телефон')->setReadonly(true)
    ];

    $form = AdminForm::card()->addElement(
      AdminDisplay::tabbed(
        [
          AdminDisplay::tab(AdminFormElement::columns()->addColumn($this->completeAttributes($id, $attributes)), 'Свойства'),
          AdminDisplay::tab(
            AdminFormElement::columns()->addColumn(
              [
                AdminFormElement::belongsTo(
                  'product',
                  [
                    AdminFormElement::text('name', 'Название')->setReadonly(true),
                    AdminFormElement::text('vendor_code', 'Артикул')->setReadonly(true),
                    AdminFormElement::image('image', 'Название')->setReadonly(true)
                  ]
                )->setReadonly(true)
              ]
            ),
            'Товар'
          ),
          AdminDisplay::tab(
            AdminFormElement::columns()->addColumn(
              [
                AdminFormElement::text('utm_source', 'utm_source')->setReadonly(true),
                AdminFormElement::text('utm_medium', 'utm_medium')->setReadonly(true),
                AdminFormElement::text('utm_campaign', 'utm_campaign')->setReadonly(true),
                AdminFormElement::text('utm_term', 'utm_term')->setReadonly(true),
                AdminFormElement::text('utm_content', 'utm_content')->setReadonly(true),
                AdminFormElement::text('referer', 'referer')->setReadonly(true),
              ]
            ),
            'UTM'
          )
        ]
      )
    );

    $form->getButtons()->setButtons(
      [
        'save' => new Save(),
        'save_and_close' => new SaveAndClose(),
        'cancel' => new Cancel(),
      ]
    );

    return $form;
  }

  public function isCreatable(): bool
  {
    return false;
  }

  public function isDeletable(Model $model): bool
  {
    return true;
  }

}
