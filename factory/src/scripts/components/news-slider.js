import Swiper from 'swiper'

window.addEventListener('load', () => {
  const slider = new Swiper('.index-news .swiper', {
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
      }
    }
  })

  // swiper wrapper height
  const swiperSlideContents = document.querySelectorAll('.index-news .swiper-slide .swiper-content');

  function setSwiperHeight() {
    const contentHeights = [];

    swiperSlideContents.forEach(el => contentHeights.push(el.scrollHeight));

    const maxContentHeight = Math.max(...contentHeights);

    swiperSlideContents.forEach(el => el.style.minHeight = `${maxContentHeight}px`)
  }

  setSwiperHeight()

  window.addEventListener('resize', setSwiperHeight)
})
