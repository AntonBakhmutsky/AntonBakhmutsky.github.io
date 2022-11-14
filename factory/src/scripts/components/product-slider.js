import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
  const slider = new Swiper('.products-slider .swiper', {
    modules: [Navigation],
    navigation: {
      nextEl: '.swiper-button-next'
    },
    loop: true,
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      640: {
        slidesPerView: 1.2,
        spaceBetween: 20
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 20
      },
      1280: {
        spaceBetween: 30,
        slidesPerView: 4,
      }
    }
  })

  // swiper wrapper height
  const swiperSlideContents = document.querySelectorAll('.products-slider .swiper-slide .swiper-slide-content');

  function setSwiperHeight() {
    const contentHeights = [];

    swiperSlideContents.forEach(el => contentHeights.push(el.scrollHeight));

    const maxContentHeight = Math.max(...contentHeights);

    swiperSlideContents.forEach(el => el.style.minHeight = `${maxContentHeight}px`)
  }

  setSwiperHeight()

  window.addEventListener('resize', setSwiperHeight)
})
