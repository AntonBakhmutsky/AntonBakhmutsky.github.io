import Swiper from 'swiper/swiper-bundle'

window.addEventListener('load', () => {
  const slider = new Swiper('.slider .swiper',{
    loop: true,
    autoplay: true,
    slidesPerView: 1,
    pagination: {
      el: '.slider .swiper-pagination',
      clickable: true
    },
    breakpoints: {
      320: {
         slidesPerView: 1
      }
    }
  })
})
