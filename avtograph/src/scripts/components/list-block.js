window.addEventListener('load', () => {
  const list = document.querySelector('.list__block');
  const input = document.querySelector('.list__input input');
  const inputBtn = document.querySelector('.list__input button');

  function createListItem(itemTitle) {
    const li = document.createElement('li');
    const check = document.createElement('div');
    const title = document.createElement('div');
    const remove = document.createElement('div');
    const innerItems = [check, title, remove];
    const innerClasses = ['list__item-check', 'list__item-title', 'list__item-remove'];

    li.classList.add('list__item');
    innerItems.forEach((el, i) => el.classList.add(innerClasses[i]));
    title.textContent = itemTitle;

    check.addEventListener('click', (event) => {
      event.target.closest('.list__item').classList.toggle('list__item_closed');
    });

    remove.addEventListener('click', (event) => {
      event.target.closest('.list__item').remove();
    });

    innerItems.forEach(el => li.insertAdjacentElement('beforeend', el));
    list.insertAdjacentElement('beforeend', li);
  }

  const addListItem = (itemTitle) => {
    createListItem(itemTitle);
    input.value = '';
  }

  inputBtn.addEventListener('click', (event) => {
    const value = event.currentTarget.previousElementSibling.value.trim();

    if (value) {
      addListItem(value);
    }
  })

  input.addEventListener('keydown', (event) => {
    const value = event.target.value.trim()

    if (event.key === 'Enter' && value) {
      addListItem(value);
    }
  })

  fetch('https://jsonplaceholder.typicode.com/todos')
    .then(response => response.json())
    .then(json => {
      for (let i = 0; i < 5; i++) {
        createListItem(json[i].title);
      }
    });
})
