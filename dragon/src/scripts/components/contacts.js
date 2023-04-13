import Swiper, {Navigation} from 'swiper'
import anime from 'animejs'

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

      const redForest = new ymaps.Placemark([59.66768456450318, 30.651756999999925], {
      }, {
        iconLayout: 'default#image',
        iconImageHref: require('@/assets/img/contacts/marker.svg'),
        iconImageSize: window.innerWidth > 1024 ? [31, 45] : [24, 35],
        iconImageOffset: window.innerWidth > 1024 ? [-10, -60] : [-10, -40],
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
            const prevBtn = switchBtns.find(el => el.classList.contains('active'))

            activateContent(switchBtns, id)
            activateContent(switchItems, id)

            switcher.insertAdjacentElement('afterbegin', switchBtns[+id])
          }
        }
      }
    }

    switcher.addEventListener('click', switchContent)

    window.addEventListener('resize', () => {
      if (winWidth !== window.innerWidth) {

      }
    })
  }
});
