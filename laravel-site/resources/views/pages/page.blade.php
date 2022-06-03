@extends('layouts.main.layout', ['mainModifier' => 'main_static'])

@section('breadcrumbs')
  {{ Breadcrumbs::render('page', $page) }}
@endsection

@section('content')
  <x-global.tabs :collection="Menu::get('topMenu')->roots()"/>

  <x-global.content :aside="true" class="content_static">
    <div class="content__text">
      {!! Tags::getTag('top_content') !!}
      {!! Tags::getTag('bottom_content') !!}
    </div>
  </x-global.content>

  <div class="product-form">
    <x-global.form title="Заказать звонок" class="form_product" image='assets/img/contacts-angel.png'/>
    <div class="container">
      <div class="product-form__decor product-form__decor_left"></div>
      <div class="product-form__decor product-form__decor_right"></div>
    </div>
  </div>
  <div class="mobile-request">
    <x-global.aside-request/>
  </div>
@endsection
