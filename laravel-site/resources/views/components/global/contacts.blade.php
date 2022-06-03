<section class="contacts" itemscope itemtype="http://schema.org/Organization">
  <div class="container">
    <span style="display: none" itemprop="name">Egranit</span>
  @unless($removeTitle)
      <h2 class="title title_section lazyload">контакты</h2>
    @endif
    <div class="contacts__items">
      <div class="contacts__item">
        <div class="contacts__item-title">график работы:</div>
        <div class="contacts__item-text">{!! Settings::get('contacts_schedule') !!}</div>
      </div>
      <div class="contacts__item">
        <div class="contacts__item-title">Телефон:</div>
        <div class="contacts__item-text">
          <a href="tel:{{ Settings::get('contacts_phone1') }}" itemprop="telephone">{{ Settings::get('contacts_phone1') }}</a>
{{--          <a href="mailto:{{ Settings::get('contacts_email') }}" itemprop="email">{{ Settings::get('contacts_email') }}</a>--}}
          <div class="contacts__socials">
            <a class="contacts__whatsap contacts__whatsap_txt" href="https://wa.me/79096423366" target="_blank" rel="noopener noreferrer">написать в WhatsApp</a>
{{--            <a class="contacts__insta" href="https://www.instagram.com/e_granit.ru/?utm_medium" target="_blank" rel="noopener noreferrer"></a>--}}
          </div>
        </div>
      </div>
      <div class="contacts__item">
        <div class="contacts__item-title">ПРОИЗВОДСТВО:</div>
        <div class="contacts__item-text" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">{!! Settings::get('contacts_address2') !!}</div>
      </div>
    </div>
    <div class="contacts__message">
      <div class="contacts__message-angel">
        <x-global.images.img src="{{ asset('assets/img/contacts-angel.png') }}" alt="contacts angel" :lazy="$lazy"/>
      </div>
      <div class="contacts__message-decor lazyload">
        <div class="contacts__message-decor-border">
          <x-global.images.img src="{{ asset('assets/img/contacts-decor-border.png') }}" alt="decor border" :lazy="$lazy"/>
        </div>
        <div class="contacts__message-decor-branch">
          <x-global.images.img src="{{ asset('assets/img/contacts-decor-branch.png') }}" alt="decor branch" :lazy="$lazy"/>
        </div>
        <div class="contacts__message-decor-bg">
          <x-global.images.img src="{{ asset('assets/img/contacts-decor-bg.png') }}" alt="decor spot" :lazy="$lazy"/>
        </div>
      </div>
      <div class="contacts__text">
        Сотрудничаем <br>
        <span>со всеми кладбищами</span> <br>
        Москвы и Московской <br>
        области
      </div>
    </div>
  </div>
</section>
