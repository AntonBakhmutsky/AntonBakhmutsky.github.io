window.addEventListener('load', () => {
  if (!document.querySelector('.diagram')) {
    return false
  } else {
    const diagramButtons = document.querySelectorAll('.diagram__drawing-btn')
    const modal = document.querySelector('.diagram__modal')
    const modalBody = document.querySelector('.diagram__modal-body')

    function showModal(e) {
      const image = e.currentTarget.previousElementSibling
      modalBody.append(image.cloneNode(true))
      modal.classList.add('active')
      document.body.classList.add('body_fix')
    }

    function closeModal(e) {
      if (e.target.classList.contains('diagram__modal') || e.target.closest('.diagram__modal-close')) {
        modal.classList.remove('active')
        document.body.classList.remove('body_fix')
        modalBody.innerHTML = ''
      }
    }

    diagramButtons.forEach(el => el.addEventListener('click', showModal))
    modal.addEventListener('click', closeModal)
  }
})
