window.addEventListener('load', () => {
  if (document.querySelector('.treatment')) {

    console.log('work')



      document.querySelector('.treatment-service-card[data-id="0"]').style.display = "flex";
      document.querySelector('.treatment-switcher-btns button[data-id="0"]').classList.add("active");

      // Получаем все кнопки и карточки
      const buttons = document.querySelectorAll('.treatment-switcher-btn');
      const cards = document.querySelectorAll('.treatment-service-card');

      // Добавляем обработчик на каждую кнопку
      buttons.forEach(function(button, index) {
      button.addEventListener("click", function() {
      // Скрываем все карточки
      cards.forEach(function(card) {
      card.style.display = "none";
    });

      // Убираем активный стиль у всех кнопок
      buttons.forEach(function(btn) {
      btn.classList.remove("active");
    });

      // Показываем карточку, связанную с нажатой кнопкой
      cards[index].style.display = "flex";

      // Добавляем активный стиль к нажатой кнопке
      button.classList.add("active");
    });
    });





  }
})
