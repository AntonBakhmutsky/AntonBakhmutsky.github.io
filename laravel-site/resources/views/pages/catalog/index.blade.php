@extends('layouts.main.layout')

@section('breadcrumbs')
  {{ Breadcrumbs::render('catalog') }}
@endsection

@section('content')
  {!! Tags::getTag('top_content') !!}
  <div class="container">
    <div class="card-grid card-grid_horizontal">
      @each('components.global.catalog-card', $categories, 'item')
    </div>
  </div>
  {!! Tags::getTag('bottom_content') !!}
@endsection
