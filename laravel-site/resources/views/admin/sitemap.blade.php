<div class="card card-default">
  <div class="card-heading card-header">
    <form method="post" action="{{ route('sitemap.refresh') }}">
      @csrf

      @if(File::exists(public_path('sitemap.xml')))
        <div class="form-group">
          <p class="control-label required">
            Текущая карта
            <i>(от @date(\Carbon\Carbon::createFromTimestamp(File::lastModified(public_path('sitemap.xml')))))</i>:
            <a download href="{{ config('app.url') . '/sitemap.xml' }}">sitemap.xml</a>
          </p>
        </div>
      @endif

      <div class="form-buttons card-footer">
        {!! $button->render() !!}
      </div>
    </form>

  </div>
</div>
