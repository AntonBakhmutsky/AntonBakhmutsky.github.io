window.addEventListener('load', () => {
  if (!document.querySelector('.faq')) {
    return false
  }

  const faqBtns = document.querySelectorAll('.faq__item-more')

  const toggleHidden = (event) => {
    const hidden = event.currentTarget.parentElement.nextElementSibling

    event.currentTarget.classList.toggle('active')
    hidden.classList.toggle('active')
    hidden.hasAttribute('style') ? hidden.removeAttribute('style') : hidden.style.maxHeight = `${hidden.scrollHeight}px`
  }

  faqBtns.forEach(el => el.addEventListener('click', toggleHidden))

})
