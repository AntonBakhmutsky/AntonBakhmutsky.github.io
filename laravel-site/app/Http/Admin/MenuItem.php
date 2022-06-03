<?php

namespace App\Http\Admin;

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
use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Section;

/**
 * Class MenuItem
 *
 * @property \App\Models\MenuItem $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
abstract class MenuItem extends Section implements Initializable
{

  use WithTimestamps;

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('menu')->addPage(
          (new Page($this->getClass()))->setPriority(0)
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    return AdminDisplay::tree()
      ->setApply(
        function (Builder $query) {
          $query
            ->selectRaw("*, CONCAT(CASE WHEN active <> true THEN '[x] ' END, name) as active_name")
            ->whereType($this->getModel()->getType())
            ->withoutTrashed();
        }
      )
      ->setMaxDepth(2)
      ->setValue('active_name')
      ->setNewEntryButtonText('Новый пункт меню')
      ->setOrderField('sort');
  }

  public function onEdit(?int $id = null, array $payload = []): FormInterface
  {
    $attributes = [
      AdminFormElement::checkbox('active', 'Активность'),
      AdminFormElement::text('name', 'Название')->required(),
      AdminFormElement::text('link', 'Ссылка')
    ];

    return AdminForm::card()->addBody(
      [
        AdminFormElement::columns()->addColumn($this->completeAttributes($id, $attributes), 'col-xs-12 col-sm-8 col-md-6 col-lg-6')
      ]
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
