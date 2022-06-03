<div class="content__slider">
  <div class="product-slider">
    <div class="swiper-wrapper">
      @foreach($product->allThumbnails(130, 130) as $item)
        <div class="swiper-slide" data-modal="modal-product-slider">
          <img class="lazyload" data-src="{{ asset($item) }}" alt="Фото {{ $product->name }}">
        </div>
      @endforeach
    </div>
    <div class="swiper-button swiper-button-prev">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.25 8.25L11.25 15L17.25 21.75" stroke="#808080" stroke-width="2"/>
        <rect x="1" y="1" width="28" height="28" stroke="#808080" stroke-width="2"/>
      </svg>
    </div>
    <div class="swiper-button swiper-button-next">
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 21.75L18 15L12 8.25" stroke="#808080" stroke-width="2"/>
        <rect x="29" y="29" width="28" height="28" transform="rotate(-180 29 29)" stroke="#808080" stroke-width="2"/>
      </svg>
    </div>
  </div>
</div>

<x-global.modal class="modal-product-slider" id="modal-product-slider">
  <x-global.swiper-wrap>
    <x-global.swiper class="gallery-thumbs" :items="$product->all_images" :alt="('Фото ' . $product->name)"/>
    <x-global.swiper class="gallery-top" :items="$product->all_images" :alt="('Фото ' . $product->name)"/>
  </x-global.swiper-wrap>
</x-global.modal>
