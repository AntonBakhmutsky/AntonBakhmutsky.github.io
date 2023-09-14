import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';


window.addEventListener('load', () => {
  let screenWidth = window.innerWidth
  let aboutSlider

    if (document.querySelector('.doctors-slider')) {
      new Swiper('.doctors-slider .swiper', {
        modules: [Navigation, Pagination],
        slidesPerView: 4,
        spaceBetween: 24,
        pagination: {
          el: '.doctors-slider .swiper-pagination',
        },
        navigation: {
          nextEl: '.doctors-slider .swiper .swiper-button-next',
          prevEl: '.doctors-slider .swiper .swiper-button-prev',
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 20
          },
          768: {
            slidesPerView: 3.1,
            spaceBetween: 20
          },
          1000: {
            slidesPerView: 4,
            spaceBetween: 24
          },
        }
      })

      const swiperSlides = document.querySelectorAll('.doctors-slider .swiper-slide')
      const swiperWrapper = document.querySelector('.doctors-slider .swiper-wrapper')

      function setSwiperDoctorsHeight() {
        const contentHeights = [];

        swiperSlides.forEach(el => contentHeights.push(el.scrollHeight));

        const maxImageHeight = Math.max(...contentHeights);

        swiperWrapper.style.height = `${maxImageHeight}px`
      }

      setSwiperDoctorsHeight()

      window.addEventListener('resize', () => {
        swiperWrapper.style.height = 'auto'
        setSwiperDoctorsHeight()
      })
    }

    if (document.querySelector('.about-main-slider')) {

      function initSwipers() {
        aboutSlider = new Swiper('.about-main-slider .swiper', {
          modules: [Navigation, Pagination],
          slidesPerView: 3,
          spaceBetween: 20,
          navigation: {
            nextEl: '.about-main-slider .swiper .swiper-button-next',
            prevEl: '.about-main-slider .swiper .swiper-button-prev',
          },
        });
      }

      function updateSwipers() {

        if (screenWidth <= 576) {
          aboutSlider.params.slidesPerView = 1
          aboutSlider.params.spaceBetween = 20
          aboutSlider.update();
        } else if (screenWidth <= 768) {
          aboutSlider.params.slidesPerView = 3
          aboutSlider.params.spaceBetween = 20
          aboutSlider.update()
        } else {
          aboutSlider.params.slidesPerView = 4
          aboutSlider.params.spaceBetween = 24
          aboutSlider.update()
        }
      }

      initSwipers()
      updateSwipers()
      window.addEventListener('resize', () => {
        updateSwipers()
      })
    }
})



