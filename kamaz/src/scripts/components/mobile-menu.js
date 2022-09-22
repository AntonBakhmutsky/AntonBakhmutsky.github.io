window.addEventListener('load', () => {

  // mobile menu
  const mobileMenu = document.querySelector('.mobile-menu');
  const mobileMenuBtn = document.querySelector('.header__mobile-btn');

  const toggleMenu = () => {
    mobileMenu.classList.toggle('active');
    document.body.classList.add('body_fix');
  }

  mobileMenuBtn.addEventListener('click', toggleMenu);

  // swipe event
  document.addEventListener('touchstart', handleTouchStart, false);
  document.addEventListener('touchmove', handleTouchMove, false);

  let xDown = null;
  let yDown = null;

  function handleTouchStart(evt) {
    xDown = evt.touches[0].clientX;
    yDown = evt.touches[0].clientY;
  }

  function handleTouchMove(evt) {
    if (!xDown || !yDown) {
      return;
    }

    let xUp = evt.touches[0].clientX;
    let yUp = evt.touches[0].clientY;

    let xDiff = xDown - xUp;
    let yDiff = yDown - yUp;
    if (Math.abs(xDiff) > Math.abs(yDiff)) {
      console.log(xDiff)
      if (xDiff > 0) {
        // left swipe
        if (mobileMenu.classList.contains('active')) {
          mobileMenu.classList.remove('active');
          document.body.classList.remove('body_fix');
        }
      } else {
        // right swipe
      }
    }

    xDown = null;
    yDown = null;
  }
});
