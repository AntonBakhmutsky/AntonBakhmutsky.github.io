window.addEventListener('DOMContentLoaded', () => {
  //vk icon
  const vk = document.querySelector('#vk');
  if (window.innerWidth < 1025) {
    vk.removeAttribute('target');
  }
  window.addEventListener('resize', () => {
      if (window.innerWidth < 1025) {
      vk.removeAttribute('target');
    } else if (window.innerWidth > 1024 && !vk.hasAttribute('target')) {
      vk.setAttribute('target', '_blank');
    }
  });
  //mobile navigation
  const menuBtn = document.querySelector('.header__menu');
  const menu = document.querySelector('.mobile__menu');
  const faqBtn = document.querySelector('.mobile__navItem[href="#faq"]');

  const toggleMenu = () => {
    menuBtn.classList.toggle('header__menu_active');
    menu.classList.toggle('mobile__menu_active');
  }

  menuBtn.addEventListener('click', toggleMenu);
  faqBtn.addEventListener('click', toggleMenu);
  

  //faq tabs
  const questions = document.querySelectorAll('.question__head');

  function toggleContent() {
    this.closest('.question').classList.toggle('question_active');
    const content = this.closest('.question').children[1];
    (content.style.maxHeight) ? content.style.maxHeight = null : content.style.maxHeight = content.scrollHeight + 'px';
  }

  questions.forEach(el => el.addEventListener('click', toggleContent));

  //to top
  const upBtn = document.querySelector('.footer__upLink');

  const toTop = () => {
    event.preventDefault();
    if (window.innerWidth > 1024) {
      window.scroll({
        top: 0,
        behavior: 'smooth'
      });
    } else {
      window.scroll({
        top: 0
      });
    }
  }

  upBtn.addEventListener('click', toTop);

  //more buttons
  const buttons = document.querySelectorAll('.howWork__desc .item__more');

  function toQuestion() {
    event.preventDefault();
    const question = document.querySelector(`#${this.id.split('_')[1]}`);
    const content = question.children[1];

    window.scrollTo(question.offsetLeft, question.offsetTop - 100);

    if (!question.classList.contains('question_active')) {
      question.classList.add('question_active');
      (content.style.maxHeight) ? content.style.maxHeight = null : content.style.maxHeight = content.scrollHeight + 'px';
    }
  }

  buttons.forEach(el => el.addEventListener('click', toQuestion));
  
});