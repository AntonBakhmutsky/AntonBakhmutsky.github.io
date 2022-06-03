<?php


namespace App\Traits\Admin;


use AdminFormElement;

trait WithTimestamps
{
  public function completeAttributes(int|string|null $id, array $attributes = []): array
  {
    if ($id) {
      $attributes[] = AdminFormElement::html('<hr>Создано');
      $attributes[] = AdminFormElement::datetime('created_at', $this->getModelValue()->created_user?->name)
        ->setVisible(true)
        ->setReadonly(true);
      $attributes[] = AdminFormElement::html('Обновлено');
      $attributes[] = AdminFormElement::datetime('updated_at', $this->getModelValue()->updated_user?->name)
        ->setVisible(true)
        ->setReadonly(true);
    }

    return $attributes;
  }
}
