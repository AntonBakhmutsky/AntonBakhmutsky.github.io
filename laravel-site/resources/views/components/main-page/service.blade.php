@if($services->count() > 0)
  <section class="service">
    <div class="service__back lazyload"></div>
    <div class="container">
      <div class="service__decor">
        <x-global.images.picture :lazy="true" :webp="asset('assets/img/service-decor.webp')" :png="asset('assets/img/service-decor.png')" alt="decor service"/>
      </div>
      <h2 class="title title_section lazyload">Наши услуги</h2>
      <div class="service__grid">

        @foreach($services as $service)
          <div class="service__item">
            <div class="service__item-image">
              <x-global.images.picture :lazy="true" :webp="$service->thumbnail(519, null, 'webp')" :jpeg="$service->thumbnail(519, null, 'jpeg')" alt="Фото {{ $service->name }}"/>
            </div>
            <div class="service__item-desc">
              <div class="service__item-text">{{ $service->name }}</div>
              @if ($link = $service->link)
                <a class="service__item-link button" href="{{ $link }}">Подробнее</a>
              @endif
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>
@endif
