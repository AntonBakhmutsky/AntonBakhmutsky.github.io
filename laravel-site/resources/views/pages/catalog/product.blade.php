@extends('layouts.main.layout', ['wrapModifier' => 'content-wrap_product'])

@section('breadcrumbs')
  {{ Breadcrumbs::render('catalog.product', $category, $product) }}
@endsection

@section('content')
  {!! Tags::getTag('top_content') !!}
  <div class="container">
    <div class="mobile-request">
      <button class="request__mobile-btn button button_black" data-modal="modal-form" data-title="Заказать {{$product->name}}">Заказать</button>
    </div>
    <div class="content">
      <div class="content__container">
        <div class="content__text">
          {!! $product->html !!}
        </div>
        @includeWhen(!empty($product->more_images), 'components.global.product-slider')
      </div>
      <aside class="content__aside">
        <x-global.aside-request/>
      </aside>
    </div>
  </div>
  {!! Tags::getTag('bottom_content') !!}

  <x-global.product-form title="Оставить заявку" :productId="$product->id" class="lazyload"/>
  <div class="mobile-request">
    <x-global.aside-request/>
  </div>

@endsection
