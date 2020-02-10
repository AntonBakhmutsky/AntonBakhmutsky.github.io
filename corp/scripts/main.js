'use strict'

//format more
window.addEventListener('load', () => {
  const moreBtn = document.querySelectorAll('.format .item__btn');
  const closeBtn = document.querySelectorAll('.format .item__close');

  const toggleHidden = () => {
    event.preventDefault();
    event.target.closest('.item').classList.toggle('item_active');
  }

  moreBtn.forEach(el => el.addEventListener('click', toggleHidden));
  closeBtn.forEach(el => el.addEventListener('click', toggleHidden));
});



//menu
window.addEventListener('DOMContentLoaded', () => {
  const menu = document.querySelector('.header__links');
  const menuBtn = document.querySelector('.header__menu');
  const links = document.querySelectorAll('.header__links .link');

  const toggleMenu = () => {
    menu.classList.toggle('header__links_active');
    menuBtn.classList.toggle('header__menu_active');
  }

  menuBtn.addEventListener('click', toggleMenu);
  links.forEach(el => el.addEventListener('click', toggleMenu));
});

//legendary modals
window.addEventListener('DOMContentLoaded', () => {
  const modalButtons = document.querySelectorAll('.legendary__items .item__btn');
  const modals = document.querySelectorAll('.legendary__modal');

  let id, modal, list;

  const showModal = () => {
    event.preventDefault();
    id = `#${event.target.id.split('_')[1]}`;
    modal = document.querySelector(id);
    modal.style.display = 'flex';
    console.log(modal);
  }

  const closeModal = () => {
    list = event.target.classList;
    if (list.contains('legendary__modal') || list.contains('modal__close')) {
      modals.forEach(el => el.removeAttribute('style'));
    }
  }
  modalButtons.forEach(el => el.addEventListener('click', showModal));
  modals.forEach(el => el.addEventListener('click', closeModal));
  
});

//limit slider
window.addEventListener('DOMContentLoaded', () => {
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
        el.addEventListener('click', slideLeft);
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
      }
      windowWidth = window.innerWidth;
    });
  }
  limitSlider(`header`);
});



//slider
window.addEventListener('DOMContentLoaded',  () => {
  const slider = (section) => {
    const slider = document.querySelector(`.${section} .slider`);
    const slides = [...slider.children];
    const length = slides.length;
    const arrowLeft = document.querySelector(`.${section} .arrow_left`);
    const arrowRight = document.querySelector(`.${section} .arrow_right`);

    let prevSlide, currSlide, nextSlide, maxLeft, maxRight, left, slideWidth, sliderWidth, windowWidth, step, position;

    const getSlidesMobile = () => {
      prevSlide = slides[length - 1];
      currSlide = slides[0];
      nextSlide = slides[1];
    }

    const getWidth = () => {
      if (section === 'adventure') {
        slideWidth = slides[0].offsetWidth;
        step = slideWidth + 30;
        maxLeft = (length * slideWidth) + (length * 30);
        sliderWidth = slider.offsetWidth;
      } else if (section === 'company') {
        slideWidth = slides[0].offsetWidth;
        step = slideWidth + 50;
        maxLeft = (length * slideWidth) + (length * 50);
        sliderWidth = slider.offsetWidth;
      }     
    }



    const getPosition = (el) => position =  Number(el.getAttribute('style').match(/\-{0,1}\d+/));
    
    const initialMobileSlider = () => {
      getSlidesMobile();
      slides.forEach(el => el.removeAttribute('style'));
      slider.innerHTML = '';
      prevSlide.classList.add('previous-slide');
      currSlide.classList.add('current-slide');
      nextSlide.classList.add('next-slide');
      slider.insertAdjacentElement('afterbegin', prevSlide);
      slider.insertAdjacentElement('afterbegin', currSlide);
      slider.insertAdjacentElement('afterbegin', nextSlide);
      arrowLeft.removeEventListener('click', moveLeftDesktop);
      arrowRight.removeEventListener('click', moveRightDesktop);
      arrowLeft.addEventListener('click', moveLeftMobile);
      arrowRight.addEventListener('click', moveRightMobile);
      arrowRight.classList.remove('arrow_disabled');
      arrowLeft.classList.remove('arrow_disabled');
    }

    const initialDesktopSlider = () => {
      left = 0;
      getWidth();
      slider.innerHTML = '';
      slides.forEach(el => {
        el.classList.remove('previous-slide');
        el.classList.remove('current-slide');
        el.classList.remove('next-slide');
        el.style.left = `${left}px`;
        slider.insertAdjacentElement('beforeend', el);
        left += step;
      });
      arrowLeft.removeEventListener('click', moveLeftMobile);
      arrowRight.removeEventListener('click', moveRightMobile);
      arrowRight.addEventListener('click', moveRightDesktop);
      arrowLeft.classList.add('arrow_disabled');
      left = sliderWidth;
    }

    const moveLeftMobile = () => {
      prevSlide.remove();
      prevSlide.classList.remove('previous-slide');
      currSlide.classList.remove('current-slide')
      currSlide.classList.add('previous-slide');
      nextSlide.classList.remove('next-slide');      
      nextSlide.classList.add('current-slide');
      slides[2].classList.add('next-slide');
      slides.push(slides[0]);
      slides.shift();
      getSlidesMobile();
      slider.insertAdjacentElement('beforeend', nextSlide);
      console.log(slides);
    }

    const moveRightMobile = () => {
      nextSlide.classList.remove('next-slide');
      nextSlide.remove();
      currSlide.classList.remove('current-slide')
      currSlide.classList.add('next-slide');
      prevSlide.classList.remove('previous-slide');      
      prevSlide.classList.add('current-slide');
      slides[length - 2].classList.add('previous-slide');
      slides.unshift(slides[length - 1]);
      slides.pop();
      getSlidesMobile();
      slider.insertAdjacentElement('afterbegin', prevSlide);
    }

    const moveLeftDesktop = () => {  
      getPosition(slides[0]);
      if (left > maxLeft || position !== 0) {
        arrowRight.addEventListener('click', moveRightDesktop);
        arrowRight.classList.remove('arrow_disabled');
      }
      if (left > sliderWidth) {
        slides.forEach(el => {
          getPosition(el);
          el.style.left = `${position + step}px`; 
        });
        left -=step;
        if (left === sliderWidth) {
          arrowLeft.removeEventListener('click', moveLeftDesktop);
          arrowLeft.classList.add('arrow_disabled');
        }
      }
    }

    const moveRightDesktop = () => {
      if (left < maxLeft) {
        slides.forEach(el => {
          getPosition(el);
          el.style.left = `${position - step}px`; 
        });
        left += step;
        if (left > maxLeft) {
          arrowRight.removeEventListener('click', moveRightDesktop);
          arrowRight.classList.add('arrow_disabled');
        }
      } 
      getPosition(slides[0]);
      if (position !== 0 && arrowLeft.classList.contains('arrow_disabled')) {
        arrowLeft.addEventListener('click', moveLeftDesktop);
        arrowLeft.classList.remove('arrow_disabled');
      }
    }

    windowWidth = window.innerWidth
    if (windowWidth < 1025) {
      initialMobileSlider();
    } else if (windowWidth > 1024) {
      initialDesktopSlider();
    }

    window.addEventListener('resize', () => {
      if (windowWidth !== window.innerWidth && window.innerWidth < 1025) {
        initialMobileSlider();
        windowWidth = window.innerWidth;
      } else if (windowWidth !== window.innerWidth && window.innerWidth > 1024) {
        initialDesktopSlider();
        windowWidth = window.innerWidth;
      }
    });
  }
  slider('adventure');
  slider('emotions');
  slider('company');
});
