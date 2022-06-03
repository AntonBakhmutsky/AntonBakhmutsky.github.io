@extends('layouts.main.layout')

@section('breadcrumbs')
  {{ Breadcrumbs::render('promotions') }}
@endsection

@section('content')
  <div class="container">
    <div class="card-grid card-grid_vertical">
      @each('components.global.promotion-card', $promotions, 'item')
    </div>
  </div>
@endsection
