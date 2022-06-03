@extends('layouts.main.layout')

@section('breadcrumbs')
  {{ Breadcrumbs::render('catalog.category', $category) }}
@endsection

@section('html')

  <x-global.content>
    <div class="content__text content__text_hidden">
      {!! $category->html !!}
    </div>
    <div class="content__more">
      <button class="content__more-btn">читать далее</button>
    </div>
  </x-global.content>

@endsection

@section('content')
  {!! Tags::getTag('top_content') !!}
  <div class="container">
    <div class="content content_vertical">
      <div class="content__container content__container_vertical">
        <div>
          @if($category->hasTopHtml())
            @yield('html')
          @endif
          <div class="card-grid card-grid_vertical">
            @each('components.global.material-card', $category->children, 'item')
          </div>
          @if($category->hasBottomHtml())
            @yield('html')
          @endif
        </div>
        <aside class="content__aside">
          @include('components.global.aside-request')
        </aside>
      </div>
    </div>
  </div>
  {!! Tags::getTag('bottom_content') !!}
  <div class="mobile-request">
    <x-global.aside-request/>
  </div>

  <x-global.modal class="modal-product-card" id="modal-product-card">
    <x-global.swiper-wrap>
      <x-global.swiper class="gallery-thumbs"/>
      <x-global.swiper class="gallery-top"/>
    </x-global.swiper-wrap>
  </x-global.modal>
@endsection
