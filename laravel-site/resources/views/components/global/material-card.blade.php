<div class="material-card .clearfix">
  <div class="material-card__image"
    @if(!empty($item->image))
      data-modal="modal-product-card" data-images='["{{ asset($item->image) }}"]'
    @endif
  >
    <x-global.images.picture :webp="$item->thumbnail(262, 267, 'webp')" :jpeg="$item->thumbnail(262, 267, 'jpeg')" alt="Материал {{ $item->name }}"/>
  </div>
  <div class="material-card__mobile-plug">&nbsp;</div>
  <div class="material-card__name">{{ $item->name }}</div>
  <p class="material-card__preview">{{ Str::limit($item->preview, 246) }}</p>
  <a class="material-card__link button button_black" href="{{ $item->link }}">СМОТРЕТЬ ВАРИАНТЫ</a>
</div>
