window.addEventListener('DOMContentLoaded', () => {
  //mobile navigation
  const menuBtn = document.querySelector('.header__menu');
  const menu = document.querySelector('.mobile__menu');

  const toggleMenu = () => {
    menuBtn.classList.toggle('header__menu_active');
    menu.classList.toggle('mobile__menu_active');
  }

  menuBtn.addEventListener('click', toggleMenu);

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
    window.scroll({
      top: 0,
      behavior: 'smooth'
    });
  }

  upBtn.addEventListener('click', toTop);
});