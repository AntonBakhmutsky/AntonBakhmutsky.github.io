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

      const map = new YMap(document.getElementById('mapRedForest'), {
        location: {
          center: [30.651756999999925, 59.66768456450318],
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
        coordinates: [30.651756999999925, 59.66768456450318],
      }, content))

      content.innerHTML = `<div class="map__marker map__marker_logo"></div>`
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

            switcher.insertAdjacentElement('afterbegin', switchBtns[+id])
          }
        }
      }
    }

    switcher.addEventListener('click', switchContent)
  }
});
