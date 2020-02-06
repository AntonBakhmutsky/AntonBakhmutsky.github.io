'use strict'

//format more
window.addEventListener('load', () => {
  const moreBtn = document.querySelectorAll('.format .item__btn')

  const showHidden = () => {
    event.preventDefault();
    event.target.closest('.item').classList.add('item_active');
  }

  moreBtn.forEach(el => el.addEventListener('click', showHidden))
});

//header slider
window.addEventListener('load', () => {
  const headerSlider = () => {
    const slider = document.querySelector('.header__slider .slider');
    const slides = [...slider.children];
    const width = slides[0].clientWidth;
    const quantity = slides.length - 2;
    const maxLeft = width * quantity * -1;
    const arrowsLeft = document.querySelectorAll('.header .arrow_left');
    const arrowsRight = document.querySelectorAll('.header .arrow_right');
    let left, step, position;

    const disableLeft = () => {
      arrowsLeft.forEach(el => {
        el.classList.add('arrow_disabled');
        el.removeEventListener('click', slideLeft);
      });
    }

    const disableRight = () => {
      arrowsRight.forEach(el => {
        el.classList.add('arrow_disabled');
        el.removeEventListener('click', slideRight);
      });
    }

    const activateLeft = () => {
      arrowsLeft.forEach(el => {
        el.classList.remove('arrow_disabled');
        el.addEventListener('click', slideLeft)
      });
    }

    const activateRight = () => {
      arrowsRight.forEach(el => {
        el.classList.remove('arrow_disabled');
        el.addEventListener('click', slideRight);
      });
    }
    
    const getPosition = () => position = Number(slider.getAttribute('style').match(/\-{0,1}\d+/));

    const startPosition = () => {              
      left = 0;
      slides.forEach((el, i) => {
        (i === 0) ? el.style.left = 0 : el.style.left = `${left}px`;
        left += width;
      });
      disableLeft();
      slider.style.left = 0;
    }
    
    const slideLeft = () => {
      getPosition();
      step = `${position + width}px`;
      console.log(position);
      if (position < (width * -1)) {
        if (position === maxLeft) {
          activateRight();
        } 
        slider.style.left = step;
      } else if (position === (width * -1)) {
        slider.style.left = step;
        disableLeft();
      }
    }
    const slideRight = () => {
      getPosition();
      step = `${position + (width * -1)}px`;
      console.log(position);
      if (position > maxLeft) {
        if (position === 0) {
          activateLeft();           
        }
        slider.style.left = step;
      } else if (position === maxLeft) {
        slider.style.left = step;
        disableRight();
      }
    }


    startPosition();  
    activateRight();
  }
  headerSlider();

  window.addEventListener('resize', () => {
    
  });
});
