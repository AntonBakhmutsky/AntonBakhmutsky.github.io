<picture>
  @if($webp)
    <x-global.images.source srcset="{{ $webp }}" type="image/webp" :lazy="$lazy"/>
    @unless($jpeg || $png)
      <x-global.images.img src="{{ $webp }}" alt="{{ $alt }}" :lazy="$lazy"/>
    @endunless
  @endif
  @if($jpeg)
    <x-global.images.source srcset="{{ $jpeg }}" type="image/jpeg" :lazy="$lazy"/>
    <x-global.images.img src="{{ $jpeg }}" alt="{{ $alt }}" :lazy="$lazy"/>
  @endif
  @if($png)
    <x-global.images.source srcset="{{ $png }}" type="image/png" :lazy="$lazy"/>
    @unless($jpeg)
      <x-global.images.img src="{{ $png }}" alt="{{ $alt }}" :lazy="$lazy"/>
    @endunless
  @endif
</picture>
