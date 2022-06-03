<footer class="footer">
  <div class="container">
    <div class="footer__item">
      <a href="{{ route('index') }}" class="logo">
        <svg width="127" height="21" viewBox="0 0 127 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M45.3212 20.5762V16.9699H35.8005V12.6134H45.1193V9.00711H35.8005V4.93917H45.3212V1.33283H31.7037V20.5762H45.3212Z"
                  fill="white"/>
            <path d="M57.8426 20.9513C61.3336 20.9513 64.0744 19.5088 66.0362 17.3161V9.93033H56.8617V13.5078H61.9394V15.8159C61.1605 16.5371 59.5448 17.2873 57.8426 17.2873C54.3517 17.2873 51.8128 14.6041 51.8128 10.969C51.8128 7.33377 54.3517 4.65066 57.8426 4.65066C59.891 4.65066 61.5355 5.80469 62.401 7.16067L65.8054 5.31423C64.3629 3.03502 61.8529 1.01547 57.8426 1.01547C52.2168 1.01547 47.6006 4.88147 47.6006 10.969C47.6006 17.0276 52.2168 20.9513 57.8426 20.9513Z"
                  fill="white"/>
            <path d="M72.866 20.5762V11.3729C73.4718 10.4785 75.0875 9.78608 76.2992 9.78608C76.7031 9.78608 77.0493 9.81493 77.309 9.87263V6.29515C75.5779 6.29515 73.8469 7.30492 72.866 8.5455V6.64136H69.2019V20.5762H72.866Z"
                  fill="white"/>
            <path d="M91.629 20.5762V11.5748C91.629 7.56458 88.7151 6.29515 85.5415 6.29515C83.3489 6.29515 81.1562 6.98757 79.4541 8.4878L80.8389 10.9401C82.0218 9.84378 83.4066 9.29562 84.9068 9.29562C86.7533 9.29562 87.965 10.2188 87.965 11.6325V13.5078C87.0418 12.4115 85.3973 11.8056 83.5508 11.8056C81.3293 11.8056 78.7039 13.0462 78.7039 16.3063C78.7039 19.4222 81.3293 20.9224 83.5508 20.9224C85.3684 20.9224 87.0129 20.2589 87.965 19.1337V20.5762H91.629ZM85.0222 18.4413C83.5797 18.4413 82.3968 17.6912 82.3968 16.3929C82.3968 15.0369 83.5797 14.2868 85.0222 14.2868C86.2051 14.2868 87.3591 14.6907 87.965 15.4985V17.2296C87.3591 18.0374 86.2051 18.4413 85.0222 18.4413Z"
                  fill="white"/>
            <path d="M108.333 20.5762V10.7382C108.333 8.02619 106.861 6.29515 103.803 6.29515C101.524 6.29515 99.8217 7.39147 98.9274 8.45895V6.64136H95.2633V20.5762H98.9274V11.1998C99.5332 10.3631 100.658 9.55527 102.101 9.55527C103.659 9.55527 104.669 10.2188 104.669 12.1518V20.5762H108.333Z"
                  fill="white"/>
            <path d="M113.788 5.14112C115 5.14112 115.981 4.1602 115.981 2.94847C115.981 1.73674 115 0.784668 113.788 0.784668C112.606 0.784668 111.596 1.73674 111.596 2.94847C111.596 4.1602 112.606 5.14112 113.788 5.14112ZM115.635 20.5762V6.64136H111.971V20.5762H115.635Z"
                  fill="white"/>
            <path d="M123.942 20.9224C125.471 20.9224 126.452 20.5185 127 20.0281L126.221 17.2584C126.019 17.4604 125.5 17.6623 124.952 17.6623C124.144 17.6623 123.682 16.9988 123.682 16.1332V9.84378H126.51V6.64136H123.682V2.83307H119.989V6.64136H117.681V9.84378H119.989V17.1142C119.989 19.5953 121.374 20.9224 123.942 20.9224Z"
                  fill="white"/>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M0 12.8552C0 6.46064 5.18359 1.27669 11.5782 1.27625H19.3603V20.5837H0V12.8552ZM11.5782 3.17432C11.5782 3.17432 11.5783 3.17432 11.5782 3.17432C6.23191 3.17472 1.89807 7.50889 1.89807 12.8552V18.6857H17.4623V3.17432H11.5782Z"
                  fill="#DE0000"/>
        </svg>
      </a>
      <div class="footer__text">
        Изготовление и ремонт памятников из мрамора и натурального гранита
      </div>
      <ul class="footer__list">
        <li>Ручная гравировка</li>
        <li>Бесплатная доставка</li>
        <li>Работа «под ключ»</li>
        <li>Гарантия 30 лет</li>
      </ul>
    </div>
    @foreach(Menu::get('bottomMenu')->roots()->slice(0, 2) as $item)
      <div class="footer__item footer__item_navigation">
        <div class="footer__title">{{ $item->title }}</div>
        @if($item->hasChildren())
          <nav class="footer__nav">
            @foreach($item->children() as $child)
              <a href="{{ $child->url() }}">{{ $child->title }}</a>
            @endforeach
          </nav>
        @endif
      </div>
    @endforeach
    <div class="footer__item" itemscope itemtype="http://schema.org/Organization">
      <span style="display: none" itemprop="name">Egranit</span>
      <div class="footer__title">Контакты</div>
      <div class="footer__contact">{!! Settings::get('contacts_schedule') !!}</div>
      @if($address = Settings::get('contacts_address1'))
        <div class="footer__contact" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">{!! $address !!}</div>
      @endif
      @if($address = Settings::get('contacts_address2'))
        <div class="footer__contact" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">{!! $address !!}</div>
      @endif
      <a class="footer__contact" href="mailto:{{ Settings::get('contacts_email') }}" itemprop="email">{{ Settings::get('contacts_email') }}</a>
      @if($phone = Settings::get('contacts_phone1'))
        <a class="footer__contact" href="tel:{{ $phone }}" itemprop="telephone">{{ $phone }}</a>
      @endif
      @if($phone = Settings::get('contacts_phone2'))
        <a class="footer__contact" href="tel:{{ $phone }}" itemprop="telephone">{{ $phone }}</a>
      @endif
      <div class="footer__socials">
        <a class="footer__socials-whatsap" href="https://wa.me/79096423366" target="_blank" rel="noopener noreferrer"></a>
{{--        <a class="footer__socials-insta" href="https://www.instagram.com/e_granit.ru/?utm_medium" target="_blank" rel="noopener noreferrer"></a>--}}
      </div>
    </div>
    <div class="footer__bottom">
      <div class="footer__copyright">
        <div>Все права защищены Egranit ©{{ date('Y') }}</div>
        <a href="{{ route('page', 'privacy') }}" target="_blank" rel="noopener noreferrer">политика конфиденциальности</a>
      </div>
      <a href="https://itleague.ru/" class="footer__create" target="_blank" rel="noopener noreferrer">Создано в IT League</a>
    </div>
  </div>
</footer>
