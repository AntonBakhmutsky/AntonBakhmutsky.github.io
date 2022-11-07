import anime from 'animejs';
import checkPosition from '../plugins/check-position';
import inViewport from '../plugins/inViewport';

window.addEventListener('load', () => {
  const scrollContainer = document.querySelector('.offers__content');
  const scrollItem = document.querySelector('.offers__scroll');
  const truck = document.querySelector('.offers__truck');
  const wheels = truck.querySelectorAll('img:not(:first-child)');
  const offersItems = document.querySelectorAll('.offers__item:not(:nth-child(1), :nth-child(2))');
  const allOffersItems = document.querySelectorAll('.offers__item');
  const truckMobile = document.querySelector('.offers__truck-mobile');
  let winWidth = window.innerWidth;

  let rotateAngle = 0;

  function addOnWheel(e) {
    e.preventDefault();

    const maxTruckLeft = scrollItem.scrollWidth - truck.offsetWidth;

    const rotateWheels = (angle) => wheels.forEach(el => el.style.transform = `rotate(${angle}deg)`);
    const getTruckLeft = () => Number(truck.style.left.replace(/[a-zа-яё]/gi, ''));

    const moveTruck = (direction) => {
      const left = getTruckLeft();
      if (direction === 'right') {
        truck.style.left = `${left + 50}px`;
      } else if (direction === 'left') {
        truck.style.left = `${left - 50}px`;
      }
    }

    let delta = e.deltaY || e.detail || e.wheelDelta;

    if (delta < 0) {
      scrollContainer.scrollLeft -= 45;
      rotateWheels(rotateAngle);
      if (getTruckLeft() > 0) {
        moveTruck('left');
      }
      rotateAngle -= 75;
    } else {
      scrollContainer.scrollLeft += 45;
      rotateWheels(rotateAngle);
      if (getTruckLeft() < maxTruckLeft) {
        moveTruck('right');
        offersItems.forEach(el => {
          const x = el.getBoundingClientRect().x;
          if (x < 1200 && Number(el.style.opacity) < 0.1) {
            anime({
              targets: el,
              opacity: [0, 1],
              translateY: [150, 0],
              duration: 1000,
              easing: 'easeOutQuart',
            })
          }
        });
      } else {
        scrollContainer.addEventListener('mousedown', dragBlock);
        scrollContainer.style.cursor = 'grab';
        scrollContainer.removeEventListener('wheel', addOnWheel);
      }
      rotateAngle += 75;
    }
  }
  if (winWidth > 1024) {
    scrollContainer.addEventListener('wheel', addOnWheel);
  } else {
    allOffersItems.forEach(el => el.removeAttribute('data-delay'));
    allOffersItems.forEach(el => el.removeAttribute('data-duration'));
    allOffersItems.forEach(el => el.classList.add('slide-up'));
  }

  function dragBlock(event) {
    event.preventDefault();
    let shiftX = event.clientX;

    document.addEventListener('mousemove', onMouseMove);
    document.addEventListener('mouseup', onMouseUp);

    function onMouseMove(event) {
      scrollContainer.scrollLeft = scrollContainer.scrollLeft + shiftX - event.clientX;
      shiftX = event.clientX;
      scrollContainer.style.cursor = 'grabbing';
    }

    function onMouseUp() {
      document.removeEventListener('mouseup', onMouseUp);
      document.removeEventListener('mousemove', onMouseMove);
      scrollContainer.style.cursor = 'grab';
    }
  }

  window.addEventListener('resize', () => {
    if (winWidth !== window.innerWidth) {
      winWidth = window.innerWidth;

      if (winWidth > 1024 && !allOffersItems[0].hasAttribute('data-delay')) {
        scrollContainer.addEventListener('wheel', addOnWheel);
        allOffersItems[0].setAttribute('data-delay', '100');
        allOffersItems[1].setAttribute('data-delay', '200');
        allOffersItems[0].setAttribute('data-duration', '1500');
        allOffersItems[1].setAttribute('data-duration', '1500');
        offersItems.forEach(el => el.classList.remove('.slide-up'));
      } else {
        scrollContainer.removeEventListener('wheel', addOnWheel);
        allOffersItems[0].removeAttribute('data-delay');
        allOffersItems[1].removeAttribute('data-delay');
        allOffersItems[0].removeAttribute('data-duration');
        allOffersItems[1].removeAttribute('data-duration');
      }
    }
  });

  // truck mobile
  let lastScrollTop = 0;
  const maxTop = scrollItem.scrollHeight - truckMobile.offsetHeight + 34;
  const truckMobileLine = document.querySelector('.offers__line-mobile')
  window.addEventListener('scroll', (e) => {
    let st = window.scrollY || document.documentElement.scrollTop;
    const getTruckTop = () => Number(truckMobile.style.top.replace(/[a-zа-яё]/gi, ''))
    let top = getTruckTop();

    inViewport(scrollContainer, () => {
      if (checkPosition(truckMobile)) {
        if (st > lastScrollTop){
          if (getTruckTop() < maxTop) {
            truckMobile.style.top = `${top + 15}px`;
          } else {
            truckMobile.style.top = `${maxTop + 13}px`;
          }
        } else {
          if (getTruckTop() > 0) {
            truckMobile.style.top = `${top - 15}px`;
          } else {
            truckMobile.style.top = `${-34}px`;
          }
        }
        lastScrollTop = st <= 0 ? 0 : st;
      }
    }, 'half')

  })
});
