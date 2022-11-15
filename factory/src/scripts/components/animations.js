window.addEventListener('load', () => {
  document.querySelectorAll('a').forEach(el => el.addEventListener('click', e => e.preventDefault()))
})
