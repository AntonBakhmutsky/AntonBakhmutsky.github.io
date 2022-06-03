@if ($paginator->hasPages() && $paginator->hasMorePages())
  <div class="card-grid__more">
    <a class="button" href="{{ $paginator->nextPageUrl() }}">ПОКАЗАТЬ ЕЩЁ</a>
  </div>
@endif
