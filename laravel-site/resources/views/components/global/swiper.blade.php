<div {{ $attributes->merge(['class' => 'swiper-container']) }}>
  <div class="swiper-wrapper">
    @foreach($items as $item)
      <div class="swiper-slide">
        <img class="lazyload" data-src="{{ $item }}" alt="{{ $alt }}">
      </div>
    @endforeach
  </div>
  <div class="swiper-button-next swiper-button-white lazyload"></div>
  <div class="swiper-button-prev swiper-button-white lazyload"></div>
</div>
