window.addEventListener('load', () => {
  if (document.querySelector('.answers')) {

    const cardsAnswer = document.querySelectorAll('.answers-card')

    cardsAnswer.forEach(card => {
      const btn = card.querySelector('.answers-card-top_btn');

      btn.addEventListener('click', () => {
        card.classList.toggle("active")
      });
    });

  }
})
