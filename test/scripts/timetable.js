window.addEventListener('load', () => {
  const btns = document.querySelectorAll('.timetable__title')

  const toggleItem = (event) => {
    const item = event.currentTarget.closest('.timetable__item')
    const hidden = item.querySelector('.timetable__hidden')
    !hidden.hasAttribute('style') ? hidden.style.maxHeight = `${hidden.scrollHeight}px` : hidden.removeAttribute('style')
    item.classList.toggle('timetable__item_open')
  }

  btns.forEach(el => el.addEventListener('click', toggleItem))  
});