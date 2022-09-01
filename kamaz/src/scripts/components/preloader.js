//
// const lottieContainer = document.querySelector('.preloader__container');
// const animationData = require('@/assets/documents/preloader.json');
// const lottieWeb = require('lottie-web');
//
// const animation = lottieWeb.loadAnimation({
//   container: lottieContainer,
//   animationData: animationData,
//   renderer: 'svg',
//   loop: true,
//   autoplay: true
// });
window.addEventListener('load', () => {
  document.body.classList.add('loaded_hiding');
  window.setTimeout(function () {
    document.body.classList.add('loaded');
    document.body.classList.remove('loaded_hiding');
  }, 300);
});
