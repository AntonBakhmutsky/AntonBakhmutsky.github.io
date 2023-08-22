import initModalImage from '@/scripts/helpers/modalImage'

window.addEventListener('load', () => {
  if (!document.querySelector('.docs')) {
    return false
  } else {
    const docs = document.querySelectorAll('.docs-card')
    initModalImage(docs)
  }
})
