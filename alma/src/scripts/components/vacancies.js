window.addEventListener('load', () => {
  if (document.querySelector('.vacancies')) {

    const vacanciesCards = document.querySelectorAll('.vacancies-item')

    vacanciesCards.forEach(card => {
      const btn = card.querySelector('.vacancies_expand-btn')

      btn.addEventListener('click', () => {
        card.classList.toggle("active")
        btn.textContent = card.classList.contains("active") ? "Свернуть описание" : "Развернуть описание";

      });
    });
  }
})
