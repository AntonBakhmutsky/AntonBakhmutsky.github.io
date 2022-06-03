@extends('layouts.main.layout')

@section('breadcrumbs')
  {{ Breadcrumbs::render('articles') }}
@endsection

@section('content')
    {!! Tags::getTag('top_content') !!}

    <div class="container">
      <div class="articles-main__grid">
        @foreach($articles as $article)
          <x-global.article-card :article="$article" :slide="false"/>
        @endforeach
      </div>
      {{ $articles->links() }}
    </div>

    {!! Tags::getTag('bottom_content') !!}
@endsection

