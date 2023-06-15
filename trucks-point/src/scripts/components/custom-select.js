window.addEventListener('load', () => {
  if (!document.querySelector('.select')) {
    return null
  } else {
    function initializeCustomSelect() {
      const selectTriggers = document.querySelectorAll('.select-trigger');


      selectTriggers.forEach(trigger => {
        const options = trigger.nextElementSibling;
        const selectedOption = trigger.parentNode.querySelector('.selected-option__text');
        const btnOpenOptions = trigger.parentNode.querySelector('.selected-option__toggle-btn');

        trigger.addEventListener('click', function(event) {
          event.stopPropagation(); // Остановить всплытие события клика
          // Закрытие других селектов
          const otherSelects = document.querySelectorAll('.select-options');
          otherSelects.forEach(select => {
            if (select !== options && select.classList.contains('flex')) {
              select.classList.remove('flex');
            }
          });

          options.classList.toggle('flex');
          btnOpenOptions.classList.toggle('rotate');
        });

        options.addEventListener('change', function() {
          const checkedOptions = Array.from(options.querySelectorAll('input[type="radio"]:checked'));
          const selectedOptionsText = checkedOptions.map(option => option.value).join(', ');
          options.classList.toggle('flex');
          btnOpenOptions.classList.toggle('rotate');
          selectedOption.style.color = '#25252D';

          selectedOption.textContent = selectedOptionsText;
        });
      });
    }

    initializeCustomSelect();

    // Обработчик клика на документе для закрытия селектов
        document.addEventListener('click', function(event) {
          const selectOptions = document.querySelectorAll('.select-options');

          selectOptions.forEach(select => {
            if (!select.contains(event.target) && select.classList.contains('flex')) {
              select.classList.remove('flex');
            }
          });
        });

  }
});
