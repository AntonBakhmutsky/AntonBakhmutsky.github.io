<?php

use App\Models\Page;
use App\Models\Setting;
use App\Traits\CheckAdminUser;
use Illuminate\Database\Migrations\Migration;

class AddPrivacyPage extends Migration
{
  use CheckAdminUser;

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    try {
      $this->checkAdminUser();
      Page::updateOrCreate(
        ['code' => 'privacy'],
        [
          'active' => true,
          'name' => 'Политика конфиденциальности',
          'html' => 'Согласие субъекта персональных данных на обработку его персональных данных.
    <br>
    Заполняя контактную форму (форму обратной связи), Вы соглашаетесь на обработку Оператором и предоставление Ваших персональным данных, (в т.ч. Имени , и (или) Адреса электронной почты, и (или) Номера телефона) для целей Вашего запроса. Оператор обязуется не распространять Ваши контактные данные и не использовать их для целей не связанных с Вашим запросом.
    <br>
    Цель сбора и обработки персональных данных – отправка пользователю информационных и новостных рассылок, прочей информации рекламного характера.'
        ]
      );

      Setting::whereKey('privacy')->firstOrFail()->delete();
    } catch (Throwable) {
    }

    Cache::forget(Setting::CACHE_KEY);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    try {
      $this->checkAdminUser();

      Setting::withTrashed()->updateOrCreate(
        ['code' => 'privacy'],
        [
          'value' => 'Согласие субъекта персональных данных на обработку его персональных данных.
    <br>
    Заполняя контактную форму (форму обратной связи), Вы соглашаетесь на обработку Оператором и предоставление Ваших персональным данных, (в т.ч. Имени , и (или) Адреса электронной почты, и (или) Номера телефона) для целей Вашего запроса. Оператор обязуется не распространять Ваши контактные данные и не использовать их для целей не связанных с Вашим запросом.
    <br>
    Цель сбора и обработки персональных данных – отправка пользователю информационных и новостных рассылок, прочей информации рекламного характера.',
          'type' => Setting::TYPE_TEXT
        ]
      )->restore();

      Page::whereCode('privacy')->firstOrFail()->delete();
    } catch (Throwable) {
    }

    Cache::forget(Setting::CACHE_KEY);
  }
}
