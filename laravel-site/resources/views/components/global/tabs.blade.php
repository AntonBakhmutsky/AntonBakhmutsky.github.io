<div class="container">
  <div class="tabs__overlay"></div>
  <div class="tabs">
    @foreach($collection as $item)
      <a class="{{ $item->isActive ? 'tabs__item tabs__item_active' : 'tabs__item' }}" href="{{ $item->url() }}">{{ $item->title }}</a>
    @endforeach
    <div class="tabs__mobile-padding">&nbsp;</div>
  </div>
</div>
