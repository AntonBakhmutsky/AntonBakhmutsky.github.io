@unless ($breadcrumbs->isEmpty())

  <ul class="breadcrumbs">
    @foreach ($breadcrumbs as $breadcrumb)

      @if (!is_null($breadcrumb->url) && !$loop->last)
        <li class="breadcrumbs__item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
      @else
        <li class="breadcrumbs__item active">{{ $breadcrumb->title }}</li>
      @endif

    @endforeach
  </ul>

@endunless
