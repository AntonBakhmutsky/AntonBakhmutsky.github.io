@if($lazy)
  <img {{ $attributes->except(['src', 'lazy'])->merge(['class' => 'lazyload']) }} data-src="{{ $attributes->get('src') }}">
@else
  <img {{ $attributes->except('lazy') }}>
@endif
