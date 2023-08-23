window.addEventListener('load', () => {
  if (document.querySelector('.reviews-main')) {

    const reviewsCards = document.querySelectorAll('.reviews-main-card')

    reviewsCards.forEach(card => {
      const btn = card.querySelector('.expand-btn')

      btn.addEventListener('click', () => {
        card.classList.toggle("active")
        btn.textContent = card.classList.contains("active") ? "Свернуть" : "Развернуть";

      });
    });
  }
})
