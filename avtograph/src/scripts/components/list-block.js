window.addEventListener('load', () => {
  const list = document.querySelector('.list__block');
  const input = document.querySelector('.list__input input');
  const inputBtn = document.querySelector('.list__input button');
  const savedTokens = localStorage.getItem('tokens');
  let tokens = {};
  console.log(savedTokens)

  if (savedTokens !== null) {
    tokens = JSON.parse(savedTokens);
    console.log(tokens)
    for (let key in tokens) {
      console.log(tokens[key])
      createListItem(tokens[key].title, false, key, tokens[key].closed)
    }
  }

  function createListItem(itemTitle, store = false, storeToken = false,  closed = false) {
    const li = document.createElement('li');
    const check = document.createElement('div');
    const title = document.createElement('div');
    const remove = document.createElement('div');
    const innerItems = [check, title, remove];
    const innerClasses = ['list__item-check', 'list__item-title', 'list__item-remove'];

    li.classList.add('list__item');

    if (storeToken) {
      li.dataset.token = storeToken;
    }

    if (closed) {
      li.classList.add('list__item_closed');
    }

    innerItems.forEach((el, i) => el.classList.add(innerClasses[i]));
    title.textContent = itemTitle;

    check.addEventListener('click', (event) => {
      const item = event.target.closest('.list__item');
      const token = item.dataset.token;

      item.classList.toggle('list__item_closed');

      if (token) {
        tokens[token].closed = !tokens[token].closed;
        updateTokens();
      }
    });

    remove.addEventListener('click', (event) => {
      const item = event.target.closest('.list__item');

      delete tokens[item.dataset.token];
      updateTokens();
      item.remove();
    });

    if (store) {
      const token = randomToken();
      li.setAttribute('data-token', token);

      const itemData = {
        title: itemTitle,
        closed: false
      }

      tokens[token] = itemData
      console.log(tokens)
      updateTokens()
    }

    innerItems.forEach(el => li.insertAdjacentElement('beforeend', el));
    list.insertAdjacentElement('afterbegin', li);
  }

  const addListItem = (itemTitle, store = false) => {
    createListItem(itemTitle, store);
    input.value = '';
  }

  inputBtn.addEventListener('click', (event) => {
    const value = event.currentTarget.previousElementSibling.value.trim();

    if (value) {
      addListItem(value,true);
    }
  })

  input.addEventListener('keydown', (event) => {
    const value = event.target.value.trim()

    if (event.key === 'Enter' && value) {
      addListItem(value, true);
    }
  })

  fetch('https://jsonplaceholder.typicode.com/todos')
    .then(response => response.json())
    .then(json => {
      for (let i = 0; i < 5; i++) {
        createListItem(json[i].title);
      }
    });

  function randomToken() {
    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
  }

  function updateTokens() {
    localStorage.setItem('tokens', JSON.stringify(tokens));
  }
})
