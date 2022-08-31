window.addEventListener('load', () => {

  if (!document.querySelector('.footer__up-btn')) {
    return false;
  } else {
    document.querySelector('.footer__up-btn').addEventListener('click', () => {
      window.scrollTo(0, 0);
    });
  }

});
