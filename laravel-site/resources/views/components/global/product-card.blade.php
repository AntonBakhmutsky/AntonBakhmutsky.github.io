<div class="product-card">
    <div class="product-card__image"
         @if(!empty($item->all_images))
             data-modal="modal-product-card" data-images="{{ json_encode(array_map('asset', $item->all_images)) }}"
            @endif
    >
        <x-global.images.picture :webp="$item->thumbnail(262, null, 'webp')" :jpeg="$item->thumbnail(262, null, 'jpeg')"
                                 alt="Фото {{ $item->name }}"/>
    </div>
    <div class="product-card__bottom">
        <div class="product-card__name">{{ $item->vendor_code ? 'АРТ. ' . $item->vendor_code : $item->name }}</div>
        @if($price = $item->price)
            <div class="product-card__price">{{ number_format($price, 0, '.', ' ') . ' руб' }}</div>
        @endif
        @if ($link = $item->link($category))
            <a class="product-card__link button button_black" href="{{ $link }}">ПОДРОБНЕЕ</a>
        @else
            <button class="product-card__link button button_black" data-title="{{ $item->name }} <br> заказать" data-modal="modal-form"
                    data-id="{{ $item->id }}">Заказать
            </button>
        @endif
    </div>
</div>

