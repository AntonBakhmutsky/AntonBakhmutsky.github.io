import Swiper, { Autoplay, Navigation, Pagination } from "swiper";

window.addEventListener('load', () => {

  const slider = new Swiper('.swiper',{
    modules: [Autoplay, Navigation, Pagination],
    loop: true,
    autoplay: true,
    slidesPerView: 4,
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1
      },
      768: {
        slidesPerView: 3
      },
      1367: {
        slidesPerView: 4
      }
    }
  })
})
