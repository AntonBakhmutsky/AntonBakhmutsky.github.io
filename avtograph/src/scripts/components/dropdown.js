window.addEventListener('load', () => {
  // dropdown
  const dropdown = document.querySelector('.filter__dropdown');
  const options = dropdown.querySelectorAll('.filter__options-item');
  const dropdownBtn = dropdown.querySelector('.filter__value');

  const toggleDropdown = () => dropdown.classList.toggle('filter__dropdown_open');

  dropdownBtn.addEventListener('click', toggleDropdown);
  options.forEach(el => el.addEventListener('click', toggleDropdown));

  window.addEventListener('click', (event) => {
    if (!event.target.closest('.filter__dropdown') && document.querySelector('.filter__dropdown_open')) {
      toggleDropdown();
    }
  })

  // filter
  const optionActiveClass = 'filter__options-item_active';
  const itemHiddenClass = 'list__item_hidden';
  const itemClosedClass = 'list__item_closed';

  function filterOutItems(event) {
    const option = event.currentTarget;
    const id = +option.dataset.id;
    const txt = option.textContent;
    const items = document.querySelectorAll('.list__item');

    options.forEach(el => el.classList.remove(optionActiveClass));
    option.classList.add(optionActiveClass);
    dropdownBtn.textContent = txt;

    switch (id) {
      case 0:
        items.forEach(el => el.classList.remove(itemHiddenClass));
        break
      case 1:
        items.forEach(el => {
          if (el.classList.contains(itemClosedClass)) {
            el.classList.remove(itemHiddenClass);
          } else {
            el.classList.add(itemHiddenClass)
          }
        });
        break
      case 2:
        items.forEach(el => {
          if (!el.classList.contains(itemClosedClass)) {
            el.classList.remove(itemHiddenClass);
          } else {
            el.classList.add(itemHiddenClass);
          }
        });
        break
    }
  }

  options.forEach(el => el.addEventListener('click', filterOutItems));
})
