@if($articles->count() > 0)
  <section class="articles lazyload" id="articles">
    <div class="container container_flex">
      <h2 class="title title_section lazyload">статьи</h2>
      <div class="articles__decor">
        <x-global.images.picture :lazy="true" :webp="asset('assets/img/angel.webp')" :png="asset('assets/img/angel.png')" alt="article angel"/>
      </div>
    </div>
    <div class="articles__cards">
      <div class="container container_flex">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            @foreach($articles as $article)
              <x-global.article-card :article="$article" slide="true"/>
            @endforeach
          </div>
          <div class="swiper-button-prev">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M23 11L15 20L23 29" stroke="#DE0000" stroke-width="2"/>
              <rect x="1" y="1" width="38" height="38" stroke="#DE0000" stroke-width="2"/>
            </svg>
          </div>
          <div class="swiper-button-next">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16 29L24 20L16 11" stroke="#DE0000" stroke-width="2"/>
              <rect x="39" y="39" width="38" height="38" transform="rotate(-180 39 39)" stroke="#DE0000" stroke-width="2"/>
            </svg>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
{{--     <div class="container container_flex"><a class="articles__link button button_black" href="{{ route('articles') }}">ВСЕ СТАТЬИ</a></div> --}}
  </section>
@endif
