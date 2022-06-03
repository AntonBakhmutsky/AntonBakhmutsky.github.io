<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('layouts.main.head')
  </head>
  <body class="preload">
    {{ Tags::getTag('google.tagmanager.noscript') }}
    @include('layouts.main.header')
    <main class="main {{ $mainModifier ?? '' }}">
      <div class="content-wrap {{ $wrapModifier ?? '' }}">
        @unlessIsHomepage
          <div class="container">
            {{ Tags::getTag('h1') }}
            @yield('breadcrumbs')
          </div>
        @endIsHomepage
        @yield('content')
      </div>
    </main>
    @include('layouts.main.footer')
  </body>
  <script src="{{ mix('js/main.js') }}" async defer></script>
  @meta_tags('footer')
</html>

