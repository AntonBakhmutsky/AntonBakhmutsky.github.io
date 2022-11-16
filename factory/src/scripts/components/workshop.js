import Swiper, {Navigation} from 'swiper'

window.addEventListener('load', () => {
  if (!document.querySelector('.workshop .swiper')) {
    return false
  } else {

    const slider = new Swiper('.workshop .swiper', {
      modules: [Navigation],
      navigation: {
        nextEl: '.swiper-button-next'
      },
      loop: true,
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 10
        }
      }
    })

    // swiper wrapper height
    const swiperSlideImages = document.querySelectorAll('.workshop .swiper-slide .swiper-slide-image');

    function setSwiperWorkshopHeight() {
      const contentHeights = [];

      swiperSlideImages.forEach(el => contentHeights.push(el.scrollHeight));

      const maxImageHeight = Math.max(...contentHeights);

      swiperSlideImages.forEach(el => el.style.minHeight = `${maxImageHeight}px`)
    }

    setSwiperWorkshopHeight()

    window.addEventListener('resize', () => {
      swiperSlideImages.forEach(el => el.removeAttribute('style'))
      setSwiperWorkshopHeight()
    })
  }
})
