@if($catalog->count() > 0)
  <section class="catalog lazyload">
    <div class="container container_flex">
      <h2 class="title title_section lazyload">Каталог памятников</h2>
        <div class="catalog__cards">
          @each('components.global.catalog-card', $catalog, 'item')
        </div>
      <a class="catalog__link button button_black" href="{{ Catalog::homepage() }}">СМОТРЕТЬ ВЕСЬ КАТАЛОГ</a>
    </div>
  </section>
@endif
