<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Traits\CheckAdminUser;
use Cache;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
  use CheckAdminUser;

  public function run(): void
  {
    $this->checkAdminUser();

    $settings = [
      'google_recaptcha_key' => [
        'value' => '6Lc1lVMaAAAAAPG2NX8Gs-VWMqienTiFil04kAvv',
        'type' => Setting::TYPE_STRING
      ],
      'google_recaptcha_secret' => [
        'value' => '6Lc1lVMaAAAAAOAZf-rYd8HcYAw-J2D3UQyZm2hK',
        'type' => Setting::TYPE_STRING
      ],
      'contacts_phone1' => [
        'value' => '+7(909)642-33-66',
        'type' => Setting::TYPE_STRING
      ],
      'contacts_phone2' => [
        'value' => '+7(963)625-49-90',
        'type' => Setting::TYPE_STRING
      ],
      'contacts_email' => [
        'value' => 'zakaz@egranit.ru',
        'type' => Setting::TYPE_STRING
      ],
      'contacts_schedule' => [
        'value' => 'Работаем ежедневно <br> с 9:00 до 00:00 без выходных',
        'type' => Setting::TYPE_STRING
      ],
      'contacts_address1' => [
        'value' => '141400, Московская обл., шоссе Новосходненское, 1',
        'type' => Setting::TYPE_STRING
      ],
      'contacts_address2' => [
        'value' => '143350, Московская обл., деревня Марушкино, Агрохимическая, 22',
        'type' => Setting::TYPE_STRING
      ],
      'main_map_coordinates' => [
        'value' => '55.591289, 37.210411',
        'type' => Setting::TYPE_STRING
      ],
      'google_analytics' => [
        'value' => 'UA-139855744-1',
        'type' => Setting::TYPE_STRING
      ],
      'google_tag_manager' => [
        'value' => 'GTM-KVTFKST',
        'type' => Setting::TYPE_STRING
      ],
      'yandex_metrika' => [
        'value' => '53579479',
        'type' => Setting::TYPE_STRING
      ],
      'yandex_verification' => [
        'value' => '11d15582e88e629f',
        'type' => Setting::TYPE_STRING
      ],
      'google_verification' => [
        'value' => '3izRpo1ZjYBxj9CzRjpmffsPjiY8v79c31r0rZLlPJk',
        'type' => Setting::TYPE_STRING
      ],
      'notification' => [
        'value' => '',
        'type' => Setting::TYPE_TEXT
      ],
      'calltouch' => [
        'value' => 'tnj5di57',
        'type' => Setting::TYPE_STRING
      ]
    ];

    foreach ($settings as $code => $setting) {
      Setting::updateOrCreate(['code' => $code], $setting);
    }

    Cache::forget(Setting::CACHE_KEY);
  }
}
