<div {{ $attributes->except('containerClass')->merge(['class' => 'form-footer']) }}>
  <div class="container form-footer__container {{ $attributes->get('containerClass') }}">
    <x-global.form title='Остались вопросы?'/>
  </div>
</div>
