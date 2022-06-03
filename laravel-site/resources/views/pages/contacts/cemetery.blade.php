@extends('layouts.main.layout', ['wrapModifier' => 'content-wrap_cemetery'])

@section('breadcrumbs')
  {{ Breadcrumbs::render('contacts.cemetery', $cemetery) }}
@endsection

@section('content')
  {!! Tags::getTag('top_content') !!}
  <div class="container container_cemetery">
    <div class="cemetery-list">
      <div class="cemetery-list__mobile-head">
        Список кладбищ
        <div class="cemetery-list__mobile-head-close lazyload"></div>
      </div>
      <div class="cemetery-list__inner">
        @foreach($cemeteries as $item)
          <a {{ $item->id === $cemetery->id ? 'class=active' : '' }} href="{{ $item->link }}">{{ $item->name }}</a>
        @endforeach
      </div>
    </div>
    <div class="cemetery-contacts">
      <button class="cemetery-contacts__btn">
        <img src="{{ asset('assets/img/tombstone.svg') }}" alt="tombstone">
        Выбрать другое кладбище
      </button>
      <h3 class="cemetery-contacts__title">{{ $cemetery->name }}</h3>
      <div class="cemetery-contacts__items">
        <div class="cemetery-contacts__item">
          <div class="cemetery-contacts__item-title">Адрес:</div>
          <div class="cemetery-contacts__item-text">{!! $cemetery->address !!}</div>
        </div>
         <div class="cemetery-contacts__item">
          <div class="cemetery-contacts__item-title">график работы:</div>
          <div class="cemetery-contacts__item-text">{!!  $cemetery->schedule !!}</div>
        </div>
        <div class="cemetery-contacts__item">
          <div class="cemetery-contacts__item-title">Телефон:</div>
          <div class="cemetery-contacts__item-text">
            @foreach($cemetery->phones as $phone)
              <a class="cemetery-contacts__item-phone" href="tel:{{ $phone }}">{{ $phone }}</a>
            @endforeach
          </div>
        </div>
      </div>
      <div class="content">
        {!! $cemetery->html !!}
      </div>
      {!! Tags::getTag('bottom_content') !!}
      <x-global.map :map="$cemetery->map" zoom="12"/>
    </div>
  </div>
@endsection
