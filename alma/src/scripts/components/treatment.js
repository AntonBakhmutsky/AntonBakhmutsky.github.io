window.addEventListener('load', () => {
  if (document.querySelector('.treatment')) {

    document.querySelector('.treatment-service-card[data-id="0"]').classList.add("active");
    document.querySelector('.treatment-switcher-btns button[data-id="0"]').classList.add("active");

    const buttons = document.querySelectorAll('.treatment-switcher-btn')
    const cards = document.querySelectorAll('.treatment-service-card')


      buttons.forEach(function(button, index) {
        button.addEventListener("click", function() {
        cards.forEach(function(card) {
        card.classList.remove("active")
      });


      buttons.forEach(function(btn) {
        btn.classList.remove("active")
      });

      // Показываем карточку, связанную с нажатой кнопкой
      cards[index].classList.add("active")

      // Добавляем активный стиль к нажатой кнопке
        button.classList.add("active")
      })
    })

  }
})
