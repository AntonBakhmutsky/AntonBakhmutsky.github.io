@extends('layouts.main.layout')

@section('breadcrumbs')
  {{ Breadcrumbs::render('articles.article', $article) }}
@endsection

@section('content')

  {!! Tags::getTag('top_content') !!}

  <x-global.content containerClass="content__container_article">
    <div>
      <div class="article-preview">{{ $article->preview }}</div>
      <div class="article-date">@date($article->active_from)</div>
      {!! $article->html !!}
    </div>
    <aside class="content__aside content__aside_article">
      <div class="request request_article">
        <div class="request__image">
          <img src="{{ asset('assets/img/angel-small.png') }}" alt="small angel">
        </div>
        <div class="request__offer">
          <div class="request__offer-text">ВЫЕЗД СПЕЦИАЛИСТА ДЛЯ <span>КОНСУЛЬТАЦИИ И ЗАМЕРА</span> <br> В ЛЮБУЮ ТОЧКУ МОСКВЫ И ОБЛАСТИ <span class="red-text">БЕСПЛАТНО</span></div>
          <button class="request__offer-btn button button_black" data-modal="modal-form" data-title="оставить заявку">ОСТАВИТЬ ЗАЯВКУ</button>
          <div class="request__offer-text"> Вам может быть <br> <span class="red-text">интересно</span></div>
        </div>
        <div class="request__container">
          @foreach($sideArticles as $article)
            <x-global.article-card :article="$article" :slide="false"/>
          @endforeach
        </div>
      </div>
    </aside>
  </x-global.content>

  {!! Tags::getTag('bottom_content') !!}

  <x-global.product-form title="Оставить заявку" class="lazyload"/>
  <div class="mobile-request">
    <x-global.aside-request/>
  </div>
@endsection
