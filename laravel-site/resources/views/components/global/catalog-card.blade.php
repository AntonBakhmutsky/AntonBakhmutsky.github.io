<a href="{{ $item->link }}" class="catalog-card">
  <div class="catalog-card__image">
    <x-global.images.picture :webp="$item->thumbnail(262, null, 'webp')" :jpeg="$item->thumbnail(262, null, 'jpeg')" alt="Фото {{ $item->name }}"/>
  </div>
  <div class="catalog-card__bottom">
    <div class="catalog-card__name">{{ $item->name }}</div>
    <button class="catalog-card__link button button_black" >ПОДРОБНЕЕ</button>
  </div>
</a>
