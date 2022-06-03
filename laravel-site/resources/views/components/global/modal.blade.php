<div {{ $attributes->merge(['class' => 'modal']) }}>
  <div class="modal__wrapper">
    <div class="modal__close"></div>
    {{ $slot }}
  </div>
</div>
