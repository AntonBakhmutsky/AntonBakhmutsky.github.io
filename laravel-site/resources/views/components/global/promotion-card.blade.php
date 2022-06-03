<div class="promotion-card">
  <div class="promotion__image">
    <img src="{{ $item->image }}" alt="Фото {{ $item->name }}">
  </div>
  <div class="promotion__content">
    <div class="promotion__name">{{ $item->name }}</div>
    <div class="promotion__description">{{ $item->preview }}</div>
    @if(isset($item->date_from) || isset($item->date_to))
      <div class="promotion__date">
        <span class="lazyload">Время проведения акции</span>
        <b> @date($item->date_from) - @date($item->date_to) </b>
      </div>
    @endif
  </div>
</div>
