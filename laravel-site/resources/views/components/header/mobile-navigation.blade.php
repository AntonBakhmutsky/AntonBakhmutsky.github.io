<div class="menu__mobile">
  <div class="menu__mobile-container">
    <div class="menu__mobile-container-inner">
      <nav class="menu__main">
       @foreach(Menu::get('mainMenu')->roots() as $item)
         <a href="{{ $item->url() }}">
           {{ $item->title }}
         </a>
       @endforeach
      </nav>
      @include('components.header.header-contacts')
    </div>
  </div>
</div>
