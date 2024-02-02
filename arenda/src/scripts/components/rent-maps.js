import Swiper, {Thumbs, Pagination} from 'swiper'

window.addEventListener('load', () => {
  if (document.querySelector('.rent__maps')) {

    const maps = [
      {address: 'Ленинградская область, Тосненский район, городской посёлок Красный Бор, Промышленная улица 3', coords: [59.66768456450318, 30.651756999999925]},
      {address: 'Московская область, Богородский городской округ, деревня Ельня, Новая улица 16А', coords: [55.84744206891417, 38.342234499999975]},
      {address: 'Республика Татарстан, Елабужский район, Федеральная трасса М7 1023 км', coords: [55.814910, 52.104819]},
      {address: 'Ростовская область, Миллерово, улица Седова 38', coords: [48.942143073699874, 40.39912449999999]}
    ]

    ymaps.ready(function () {
      const tosnoMap = new ymaps.Map('tosnoMap', {
        center: maps[0].coords,
        zoom: 12,
        controls: ['geolocationControl']
      }, {
        searchControlProvider: 'yandex#search'
      })
      const elnyiaMap = new ymaps.Map('elnyiaMap', {
        center: maps[1].coords,
        zoom: 12,
        controls: ['geolocationControl']
      }, {
        searchControlProvider: 'yandex#search'
      })
      const elabugaMap = new ymaps.Map('elabugaMap', {
        center: maps[2].coords,
        zoom: 12,
        controls: ['geolocationControl']
      }, {
        searchControlProvider: 'yandex#search'
      })
      const rostovMap = new ymaps.Map('rostovMap', {
        center: maps[3].coords,
        zoom: 12,
        controls: ['geolocationControl']
      }, {
        searchControlProvider: 'yandex#search'
      })


      function setGeoObjects(address, map) {
        const placemark = new ymaps.Placemark(address.coords, {
          hintContent: address.address,
        }, {
          iconLayout: 'default#image',
          iconImageHref: require('@/assets/img/contacts/map-marker.svg'),
          iconImageSize: [31, 52],
          iconContentOffset: [0, 0],
        })

        map.geoObjects.add(placemark)
      }

      const currentMaps = [tosnoMap, elnyiaMap, elabugaMap, rostovMap]

      maps.forEach((el, i) => setGeoObjects(el, currentMaps[i]))
    })

    const thumbSlider = new Swiper('.swiper.swiper_thumb', {
      spaceBetween: 24,
      slidesPerView: 4,
      direction: 'vertical'
    })
    new Swiper('.swiper.swiper_main', {
      modules: [Pagination, Thumbs],
      slidesPerView: 1,
      spaceBetween: 10,
      effect: 'fade',
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      thumbs: {
        swiper: thumbSlider,
      },
      breakpoints: {
        1025: {
          allowTouchMove: false
        }
      }
    })


  }
})
