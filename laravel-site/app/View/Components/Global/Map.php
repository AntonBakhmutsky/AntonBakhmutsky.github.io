<?php

namespace App\View\Components\Global;

use App\Helpers;
use Illuminate\View\Component;
use Illuminate\View\View;
use JetBrains\PhpStorm\ArrayShape;
use Settings;
use Tags;

class Map extends Component
{
  public function __construct(
    private ?Helpers\Map $map = null,
    private int $zoom = 9,
    private float $offset = 0
  ) {
    $this->map ??= new Helpers\Map(Settings::get('main_map_coordinates'));
    Tags::addTag('map', new \App\MetaTags\Map(mix('js/map.js')));
  }

  public function render(): View|string
  {
    return view('components.global.map');
  }

  #[ArrayShape(['lat' => "float", 'lng' => "float", 'zoom' => "int"])]
  public function getOptions(): array
  {
    return [
      'lat' => $this->map->getLat(),
      'lng' => $this->map->getLng() + $this->offset,
      'zoom' => $this->zoom
    ];
  }

  #[ArrayShape(['title' => "string", 'lat' => "float", 'lng' => "float", 'iconUrl' => "string", 'iconSize' => "int[]", 'iconAnchor' => "int[]"])]
  public function getMarker(): array
  {
    return [
      'title' => Settings::get('contacts_address2'),
      'lat' => $this->map->getLat(),
      'lng' => $this->map->getLng(),
      'iconUrl' => asset('assets/img/marker.png'),
      'iconSize' => [45, 61],
      'iconAnchor' => [23, 61]
    ];
  }
}
