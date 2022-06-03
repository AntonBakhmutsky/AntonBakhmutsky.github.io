@extends('layouts.main.layout', ['mainModifier' => 'main_contacts'])

@section('breadcrumbs')
  {{ Breadcrumbs::render('contacts') }}
@endsection

@section('content')
  {!! Tags::getTag('top_content') !!}
  <x-global.contacts :removeTitle="true"/>
  <x-global.map offset="0.35"/>
  <x-main-page.form-footer class="form-footer_contacts" containerClass="form-footer__container_contacts"/>
  <section class="cemeteries">
    <div class="container">
      <h2 class="cemeteries__title">У нас есть официальное разрешение от ГБУ "Ритуал" <br> для въезда и установки на любом кладбище Москвы и МО</h2>
      <div class="cemeteries__collection">
        @foreach($cemeteries as $item)
          <a class="cemeteries__link" href={{ $item->link }}>{{ $item->name }}</a>
        @endforeach
      </div>
      <button class="cemeteries__btn cemeteries__btn_disabled button">показать еще</button>
    </div>
  </section>
  {!! Tags::getTag('bottom_content') !!}
@endsection
