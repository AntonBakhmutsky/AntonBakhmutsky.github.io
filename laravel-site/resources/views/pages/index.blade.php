@extends('layouts.main.layout', ['mainModifier' => 'main_homepage'])

@php
  Tags::addLink('grid.jpg', ['href' => '/images/grid.jpg', 'rel' => "preload", 'as' => "image"])
@endphp

@section('content')
  <div class="main__back"></div>
  <x-main-page.offer/>
  <x-main-page.catalog :catalog="$catalog"/>
  <x-main-page.service :services="$services"/>
  <x-main-page.articles :articles="$articles"/>`
  <x-main-page.production/>
  <x-global.contacts :lazy="true"/>
  <x-global.map offset="0.35"/>
  <x-main-page.form-footer/>
@endsection
