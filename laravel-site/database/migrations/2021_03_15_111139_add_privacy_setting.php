<?php

use App\Models\Setting;
use App\Traits\CheckAdminUser;
use Illuminate\Database\Migrations\Migration;

class AddPrivacySetting extends Migration
{
  use CheckAdminUser;

  public function up()
  {
    try {
      $this->checkAdminUser();

      Setting::updateOrCreate(
        ['code' => 'privacy'],
        [
          'value' => 'Согласие субъекта персональных данных на обработку его персональных данных.
    <br>
    Заполняя контактную форму (форму обратной связи), Вы соглашаетесь на обработку Оператором и предоставление Ваших персональным данных, (в т.ч. Имени , и (или) Адреса электронной почты, и (или) Номера телефона) для целей Вашего запроса. Оператор обязуется не распространять Ваши контактные данные и не использовать их для целей не связанных с Вашим запросом.
    <br>
    Цель сбора и обработки персональных данных – отправка пользователю информационных и новостных рассылок, прочей информации рекламного характера.',
          'type' => Setting::TYPE_TEXT
        ]
      );
    } catch (Throwable) {
    }

    Cache::forget(Setting::CACHE_KEY);
  }

  public function down()
  {
    Cache::forget(Setting::CACHE_KEY);
  }
}
