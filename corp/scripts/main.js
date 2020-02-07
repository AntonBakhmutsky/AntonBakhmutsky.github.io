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

window.addEventListener('DOMContentLoaded', () => {
  //limit slider
  const limitSlider = (section) => {
    const slider = document.querySelector(`.${section} .slider`);
    const slides = [...slider.children];
    const arrowsLeft = document.querySelectorAll(`.${section} .arrow_left`);
    const arrowsRight = document.querySelectorAll(`.${section} .arrow_right`);
    
    let left, step, position, width, quantity, maxLeft, windowWidth;
    
    //path to img slides 
    const pathToSlides = () => {
      const pathArr = [];
      let value;
      slides.forEach(el => pathArr.push(el.getAttribute('src')));
      value = pathArr[0].split('_')[1];
      if (window.innerWidth < 500 && value === 'desktop') {
        pathArr.forEach((el, i) => {
          slides[i].setAttribute('src', el.replace('desktop', 'mobile')); 
        });
      } else if (window.innerWidth > 500 && value === 'mobile') {
        pathArr.forEach((el, i) => {
          slides[i].setAttribute('src', el.replace('mobile', 'desktop')); 
        });
      }
    }

    if (slides[0].hasAttribute('src') && /(mobile)|(desktop)/.test(slides[0].getAttribute('src'))) {
      pathToSlides();
    }    
    
    //slide width
    const getSlideWidth = () => {
      width = slider.clientWidth;
      quantity = slides.length - 2;
      maxLeft = width * quantity * -1;
    }

    //arrows
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
    
    //slider position
    const getPosition = () => position = Number(slider.getAttribute('style').match(/\-{0,1}\d+/));

    const changePosition = () => {

    }

    //onload and resize position    
    const startPosition = () => {              
      getSlideWidth();
      left = 0;
      slides.forEach((el, i) => {
        (i === 0) ? el.style.left = 0 : el.style.left = `${left}px`;
        left += width;
      });
      disableLeft();
      activateRight();
      slider.style.left = 0;
    }
    
    //to left
    const slideLeft = () => {
      getPosition();
      step = `${position + width}px`;
      if (position < (width * -1)) {
        if (position === (maxLeft - width)) {
          activateRight();
        } 
        slider.style.left = step;
      } else if (position === (width * -1)) {
        slider.style.left = step;
        disableLeft();
      }
    }
    //to right
    const slideRight = () => {
      getPosition();
      step = `${position + (width * -1)}px`;
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
    //resize window
    windowWidth = window.innerWidth;
    window.addEventListener('resize', () => {
      if (window.innerWidth !== windowWidth) {
        startPosition();
        if (slides[0].hasAttribute('src') && /(mobile)|(desktop)/.test(slides[0].getAttribute('src'))) {
          pathToSlides();
        }
        console.log(window.innerWidth);
      }
      windowWidth = window.innerWidth;
    });
  }
  limitSlider(`header`);

});
