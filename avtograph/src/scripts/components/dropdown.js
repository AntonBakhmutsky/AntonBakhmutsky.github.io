window.addEventListener('load', () => {
  const dropdown = document.querySelector('.filter__dropdown');
  const options = dropdown.querySelectorAll('.filter__dropdown-options-item');
  const dropdownBtn = dropdown.querySelector('.filter__value');

  const toggleDropdown = () => dropdown.classList.toggle('filter__dropdown_open');

  dropdownBtn.addEventListener('click', toggleDropdown);
  options.forEach(el => el.addEventListener('click', toggleDropdown));

  window.addEventListener('click', (event) => {
    if (!event.target.closest('.filter__dropdown') && document.querySelector('.filter__dropdown_open')) {
      toggleDropdown();
    }
  })
})
