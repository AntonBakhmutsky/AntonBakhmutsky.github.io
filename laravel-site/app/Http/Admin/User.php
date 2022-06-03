<?php

namespace App\Http\Admin;

use AdminColumn;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use AdminNavigation;
use App\Traits\Admin\WithTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;
use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Navigation\Page;
use SleepingOwl\Admin\Section;

/**
 * Class User
 *
 * @property \App\Models\User $model
 *
 * @see https://sleepingowladmin.ru/#/ru/model_configuration_section
 */
class User extends Section implements Initializable
{
  use WithTimestamps;


  /**
   * @var bool
   */
  protected $checkAccess = false;

  /**
   * @var string
   */
  protected $title = 'Пользователи';

  /**
   * Initialize class.
   */
  public function initialize()
  {
    app()->booted(
      function () {
        AdminNavigation::getPages()->findById('system')->addPage(
          (new Page($this->getClass()))->setPriority(0)->setIcon('fas fa-user-alt')
        );
      }
    );
  }

  public function onDisplay(array $payload = []): DisplayInterface
  {
    $columns = [
      AdminColumn::link('name', 'ФИО')->setSearchable(true),
      AdminColumn::email('email', 'Email')->setSearchable(true)
    ];

    return AdminDisplay::datatables()
      ->setName('firstdatatables')
      ->setOrder([[0, 'asc']])
      ->setDisplaySearch(true)
      ->paginate(25)
      ->setColumns($columns)
      ->setNewEntryButtonText('Новый пользователь')
      ->setHtmlAttribute('class', 'table-primary table-hover th-center');
  }

  public function onEdit(?int $id = null, array $payload = []): FormInterface
  {
    $uniqueRule = Rule::unique($this->getModel()->getTable(), 'email')->whereNotNull('deleted_at');
    $attributes = [
      AdminFormElement::text('name', 'ФИО')
        ->required()->setValidationRules('required|string:255'),
      AdminFormElement::text('email', 'Email')
        ->required()->setValidationRules(
          [
            'required',
            'string:255',
            'email',
            ! is_null($id) ? $uniqueRule->ignore($id) : $uniqueRule
          ]
        ),
      AdminFormElement::password('password', 'Пароль')->hashWithBcrypt()->allowEmptyValue(),
    ];

    $form = AdminForm::card()->addBody($this->completeAttributes($id, $attributes));

    $form->getButtons()->setButtons(
      [
        'save' => new Save(),
        'save_and_close' => new SaveAndClose(),
        'delete' => new Delete(),
        'cancel' => new Cancel(),
      ]
    );

    return $form;
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
