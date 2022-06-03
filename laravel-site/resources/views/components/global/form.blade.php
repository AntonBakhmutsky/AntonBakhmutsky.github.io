{{ Form::open(['route' => 'request', 'class' => $attributes->merge(['class' => 'form'])->get('class')]) }}

  {{ Form::hidden('type', 'call') }}
  {{ $showProductInput() }}

  <div class="form__container">
    <div class="form__response">
    <img src="{{ asset('assets/img/logo.png') }}" width="127" height="21"  alt="response logo">
    <div class="form__response-text">
      Ваша заявка принята. <br> В ближайшее время с Вами свяжется менеджер.
    </div>
    </div>
    <div class="form__title lazyload">{!! $title !!}</div>
    <div class="form__text">
      Оставьте свои контактные данные
      и мы свяжемся с вами в течение 15 мин.
    </div>
    <div class="form__input">
      {{ Form::text('name', null, ['placeholder'=>"Имя", 'autocomplete'=>"off", 'required']) }}
      <div class="form__input-error">Обязательное поле</div>
    </div>
    <div class="form__input">
      {{ Form::text('phone', null, ['placeholder'=>"Номер телефона", 'autocomplete'=>"off", 'required']) }}
      <div class="form__input-error">Обязательное поле</div>
    </div>
    {{ Form::button('отправить', ['class' => ['form__submit', 'button', 'button_black'], 'type' => 'submit']) }}
    <div class="form__agreement">
      Нажимая кнопку "Отправить", вы даете согласие на обработку ваших
      <a href="{{ route('page', 'privacy') }}">персональных данных</a>
    </div>
  </div>
  {{ $showImage() }}
{{ Form::close() }}
