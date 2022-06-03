@extends('layouts.main.layout')

@section('breadcrumbs')
  {{ Breadcrumbs::render('catalog.category', $category) }}
@endsection

@section('html')

  <x-global.content :aside="true">
    <div class="content__text content__text_hidden">
      {!! $category->html !!}
    </div>
    <div class="content__more">
      <button class="content__more-btn">читать далее</button>
    </div>
  </x-global.content>

@endsection

@section('content')
  <x-global.tabs :collection="$category->tabs"/>
  {!! Tags::getTag('top_content') !!}
  @if($category->hasTopHtml())
    @yield('html')
  @endif
  <div class="container">
    <div class="card-grid card-grid_horizontal">
      @each('components.global.catalog-card', $category->children, 'item')
      @foreach($category->products as $item)
        <x-global.product-card :item="$item" :category="$category"/>
      @endforeach
      {{ $category->products->links() }}
    </div>
  </div>
  @if($category->hasBottomHtml())
    @yield('html')
  @endif
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
