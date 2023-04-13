import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.contacts')) {
    return null
  } else {

    // maps
    ymaps.ready(function () {
      const map = new ymaps.Map('mapRedForest', {
        center: [59.66768456450318, 30.651756999999925],
        zoom: 13,
        controls: [],
      })

      const iconContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div class="map__address">$[properties.iconContent]</div>'
      )

      const redForest = new ymaps.Placemark([59.66768456450318, 30.651756999999925], {
      }, {
        iconLayout: 'default#image',
        iconImageHref: require('@/assets/img/contacts/marker.svg'),
        iconImageSize: window.innerWidth > 1024 ? [43, 72] : [29, 48],
        iconImageOffset: window.innerWidth > 1024 ? [-30, -80] : [-10, -40],
      })

      map.geoObjects.add(redForest)
    });

    // contacts slider
    const swipers = document.querySelectorAll('.contacts__list.swiper')

    swipers.forEach(el => {
      new Swiper(el, {
        modules: [Navigation],
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          320: {
            slidesPerView: 1
          },
          1024: {
            slidesPerView: 2
          },
          1400: {
            slidesPerView: 3
          },
          1520: {
            slidesPerView: 2
          },
          1720: {
            slidesPerView: 3
          }
        }
      })
    })

    // contacts switcher
    const switchBtns = document.querySelectorAll('.contacts__switcher-btn')

    function switchContent(e) {

    }

    switchBtns.forEach(el => el.addEventListener('click', switchContent))
  }
});
