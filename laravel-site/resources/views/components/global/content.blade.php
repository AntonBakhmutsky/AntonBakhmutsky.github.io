<div class="container">
  <div {{ $attributes->except('containerClass')->merge(['class' => 'content']) }}>
    <div class="content__container {{ $attributes->get('containerClass') }}">
      {{ $slot }}
    </div>

    @if($aside ?? false)
      <aside class="content__aside">
        <x-global.aside-request/>
      </aside>
    @endif
  </div>
</div>
