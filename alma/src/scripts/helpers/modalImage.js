export default function initModalImage(elements) {
  function showImage(e) {
    const image = e.currentTarget.querySelector('img').cloneNode(true)
    const modal = document.querySelector('.modal_image')
    const modalImageContainer = modal.querySelector('.modal__img')

    modalImageContainer.innerHTML = ''
    modalImageContainer.insertAdjacentElement('afterbegin', image)

    modal.classList.add('active')
  }

  elements.forEach(el => el.addEventListener('click', showImage))
}
