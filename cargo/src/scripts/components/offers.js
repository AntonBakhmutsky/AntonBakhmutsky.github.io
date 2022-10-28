import anime from 'animejs';

window.addEventListener('load', () => {
  const scrollContainer = document.querySelector('.offers__content');
  const scrollItem = document.querySelector('.offers__scroll');
  const truck = document.querySelector('.offers__truck');
  const wheels = truck.querySelectorAll('img:not(:first-child)');
  const offersItems = document.querySelectorAll('.offers__item:not(:nth-child(2), :nth-child(3))');

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
              duration: 1500,
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

  scrollContainer.addEventListener('wheel', addOnWheel);

  function dragBlock(event) {
    event.preventDefault();
    let shiftX = event.clientX;
    console.log(shiftX)

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
});
