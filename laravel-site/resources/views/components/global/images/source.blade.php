@if($lazy)
  <source {{ $attributes->except(['srcset', 'lazy'])->merge(['class' => 'lazyload']) }} data-srcset="{{ $attributes->get('srcset') }}">
@else
  <source {{ $attributes->except('lazy') }}>
@endif
