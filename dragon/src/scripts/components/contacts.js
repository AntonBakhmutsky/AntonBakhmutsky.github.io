import Swiper, {Navigation} from 'swiper'
import anime from 'animejs'

window.addEventListener('load', () => {
  if (!document.querySelector('.contacts')) {
    return null
  } else {

    // maps
    main();
    async function main() {
      await ymaps3.ready
      const {
        YMap,
        YMapDefaultSchemeLayer,
        YMapMarker,
        YMapControls,
        YMapDefaultFeaturesLayer
      } = ymaps3

      const {YMapZoomControl, YMapGeolocationControl} = await ymaps3.import('@yandex/ymaps3-controls@0.0.1');
      const {YMapOpenMapsButton} = await ymaps3.import('@yandex/ymaps3-controls-extra')

      const mapsArr = [
        {id: 'mapRedForest', coords: [30.651756999999925, 59.66768456450318]},
        {id: 'mapRedForest5', coords: [30.375390499999998, 60.055807064037396]},
        {id: 'mapRedForest1', coords: [52.104973, 55.815162]},
        {id: 'mapRedForest2', coords: [104.11142954398734, 52.22521718034677]},
        {id: 'mapRedForest3', coords: [40.394136006099025, 48.938808096182676]},
        {id: 'mapRedForest4', coords: [38.477352635989014, 55.59590622558263]},
      ]

      mapsArr.forEach(el => addMaps(el))

      function addMaps(mapData) {
        const map = new YMap(document.getElementById(mapData.id), {
          location: {
            center: mapData.coords,
            zoom: 13
          },
        })

        map.addChild(new YMapControls({position: 'right'}).addChild(new YMapZoomControl({})))
        map.addChild(new YMapDefaultFeaturesLayer({id: 'features'}))
        map.addChild(new YMapControls({position: 'left'}).addChild(new YMapGeolocationControl({})))
        map.addChild(new YMapControls({position: 'top left'}).addChild(new YMapOpenMapsButton({})))

        map.addChild(new YMapDefaultSchemeLayer())

        const content = document.createElement('div')

        map.addChild(new YMapMarker({
          coordinates: mapData.coords,
        }, content))

        content.innerHTML = `<div class="map__marker map__marker_logo"></div>`
      }

    }

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
    const switcher = document.querySelector('.contacts__switcher')
    const switchItems = document.querySelectorAll('.contacts__content-item')
    const switchBtns = [...document.querySelectorAll('.contacts__switcher-btn')]
    const winWidth = window.innerWidth

    const activateContent = (arr, id) => {
      arr.forEach(el => {
        if (el.dataset.id === id) {
          el.classList.add('active')

          if (el.classList.contains('contacts__content-item')) {
            anime({
              targets: el,
              opacity: [0, 1],
              duration: 1000,
              easing: 'easeOutQuart'
            })
          }
        } else {
          el.classList.remove('active')
        }
      })
    }


    function switchContent(e) {
      if (window.innerWidth > 1024) {
        const btn = e.target.closest('.contacts__switcher-btn')
        const id = btn.dataset.id

        activateContent(switchBtns, id)
        activateContent(switchItems, id)
      } else {
        if (!switcher.classList.contains('open')) {
          switcher.classList.add('open')
          switcher.style.maxHeight = `${switcher.scrollHeight}px`
        } else {
          const btn = e.target.closest('.contacts__switcher-btn')
          switcher.classList.remove('open')
          switcher.removeAttribute('style')

          if (!btn.classList.contains('active')) {
            const id = btn.dataset.id

            activateContent(switchBtns, id)
            activateContent(switchItems, id)

            switcher.insertAdjacentElement('afterbegin', switchBtns.find(el => el.dataset.id === id))
          }
        }
      }
    }

    switcher.addEventListener('click', switchContent)
  }
});
