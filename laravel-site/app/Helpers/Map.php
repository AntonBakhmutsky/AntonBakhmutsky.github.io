<?php


namespace App\Helpers;


class Map
{
  private float $lat;
  private float $lng;

  public function __construct(float|array|string $lat, float|string|null $lng = null)
  {
    if (is_null($lng)) {
      if (is_array($lat)) {
        $coordinates = array_slice(array_pad($lat, 2, 0), 0, 2);
      } else {
        $coordinates = explode(',', $lat, 2);
        $coordinates = $coordinates !== false ? (count($coordinates) < 2 ? [$coordinates[0], 0] : $coordinates) : [0, 0];
      }
    } else {
      $coordinates = [$lat, $lng];
    }
    $coordinates = array_map(fn($value) => trim((string)floatval(str_replace(',', '.', $value))), $coordinates);

    $this->lat = $coordinates[0];
    $this->lng = $coordinates[1];
  }

  public function getLat(): float
  {
    return $this->lat;
  }

  public function getLng(): float
  {
    return $this->lng;
  }
}
