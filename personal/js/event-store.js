window.addEventListener('load', () => {

  //fixed-menu
  const menu = document.querySelector('.fixed_menu');
  const navBtn = document.querySelector('.nav_btn');
  const closeMenu = document.querySelector('.fixed_menu .close');

  const toggleMenu = () => {
    menu.classList.toggle('active');
  }

  navBtn.addEventListener('click', toggleMenu);
  closeMenu.addEventListener('click', toggleMenu);


  //fixed-profile
  const profile = document.querySelector('.fixed_profile');
  const profileButtons = document.querySelectorAll('.toggleProfile');
  const closeProfile = document.querySelector('.fixed_profile .close');

  const toggleProfile = () => {
    profile.classList.toggle('active');
  }

  profileButtons.forEach(el => el.addEventListener('click', toggleProfile));
  closeProfile.addEventListener('click', toggleProfile);


  //format buttons
  const formatBtns = document.querySelectorAll('.formatButton');

  const activateBtn = () => {
    event.preventDefault();
    formatBtns.forEach(el => el.classList.remove('formatButton_active'));
    event.target.classList.add('formatButton_active');
  }
 
  formatBtns.forEach(el => el.addEventListener('click', activateBtn));


  //card counter
  const minus = document.querySelectorAll('.count__minus');
  const plus = document.querySelectorAll('.count__plus');
  let number, count, nextPrice, currentPrice, nextSum, currentSum, price = 500;

  const checkSiblings = () => {
    if (event.target.closest('.bottom__block').children.length === 3) {

      nextPrice = event.target.closest('.bottom__block').children[0].children[1].children[0];
      nextSum = Number(nextPrice.innerText);    

      currentPrice = event.target.closest('.bottom__block').children[1].children[1].children[0];
      currentSum = Number(currentPrice.innerText);

    } else {
      currentPrice = event.target.closest('.bottom__block').children[0].children[1].children[0];
      currentSum = Number(currentPrice.innerText);
    }
  }

  const increase = () => {
    number = event.target.previousElementSibling
    count = Number(number.innerText);

    checkSiblings();

    if (nextPrice !== undefined) {
      nextSum += price;
      nextPrice.innerText = nextSum;
    }
    
    currentSum += price;
    count++;
    
    currentPrice.innerText = currentSum;
    number.innerText = count;
  }
  const decrease = () => {
    number = event.target.nextElementSibling
    count = Number(number.innerText);

    checkSiblings();

    if (count !== 0) {

      if (nextPrice !== undefined) {
        nextSum -= price;
        nextPrice.innerText = nextSum;
      }
      
      currentSum -= price;
      count--;
      
      currentPrice.innerText = currentSum;
      number.innerText = count;
    }    
  }

  plus.forEach(el => el.addEventListener('click', increase));
  minus.forEach(el => el.addEventListener('click', decrease));

  //buy modal
  const buttons = document.querySelectorAll('.card .redButton');
  const modalWithSelect = document.querySelector('.event__modal_withSelect');
  const modalWithoutSelect = document.querySelector('.event__modal_withoutSelect');
  const cardModals = document.querySelectorAll('.event__modal');

  const showCardModal = () => {
    event.preventDefault();
    if (event.target.closest('.card').classList.contains('event_1')) {
      modalWithSelect.style.display = 'flex';
    } else if (event.target.closest('.card').classList.contains('event_2')) {
      modalWithoutSelect.style.display = 'flex';
    } 
  }

  const closeCardModal = () => {
    const list = event.target.classList;
    if (list.contains('event__modal') || list.contains('modal__close')) {
      cardModals.forEach(el => el.removeAttribute('style'));
    }
  }

  buttons.forEach(el => el.addEventListener('click', showCardModal));
  cardModals.forEach(el => el.addEventListener('click', closeCardModal));
});