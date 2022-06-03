<div class="card card-default">
  <div class="card-heading card-header">

    <form method="post" action="{{ route('cache.clear') }}">
      @csrf
      <div class="form-group">
        <p class="control-label">
          Текущий размер закэшированных картинок: {{ $totalImageSize }} Мб
        </p>
      </div>
      <div class="form-buttons card-footer">{!! $clearImagesButton->render() !!}</div>
    </form>

    <form method="post" action="{{ route('cache.clear') }}">
      @csrf
      <input type="hidden" name="all" value="1">
      <div class="form-buttons card-footer">{!! $clearAllButton->render() !!}</div>
    </form>



  </div>
</div>
