<a href="{{ $article->link }}" class="article-card article-card_{{ $article->type }} {{ $slide  ? 'swiper-slide' : null }}">
  <div class="article-card__image">
    <div class="article-card__image-overlay-desktop"
         style="background: linear-gradient(180deg, rgba({{ $article->color[0] }}, {{ $article->color[1] }}, {{ $article->color[2] }}, 0) 0%, rgba({{ $article->color[0] }}, {{ $article->color[1] }}, {{ $article->color[2] }}) 74.53%)"></div>
    <div class="article-card__image-overlay-mobile"
         style="background: linear-gradient(180deg, rgba({{ $article->color[0] }}, {{ $article->color[1] }}, {{ $article->color[2] }}, 0) 0%, rgba({{ $article->color[0] }}, {{ $article->color[1] }}, {{ $article->color[2] }}) 100%)"></div>
    <div class="article-card__image-overlay-hover"
         style="background: rgba({{ $article->color[0] }}, {{ $article->color[1] }}, {{ $article->color[2] }}, 0.7)"></div>
    <x-global.images.picture :webp="$article->thumbnail(710, null, 'webp')" :jpeg="$article->thumbnail(710, null, 'jpeg')" alt="Фото {{ $article->name }}" :lazy="$lazy ?? true"/>
  </div>
  <div class="article-card__bottom">
    <div class="article-card__preview">{{ $article->preview }}</div>
    <div class="article-card__date">@date($article->active_from)</div>
    <div class="article-card__button">
      <button class="article-card__link button button_white">читать</button>
    </div>
  </div>
</a>
