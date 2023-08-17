window.addEventListener('load', () => {
  if (document.querySelector('.answers')) {

    const cardsAnswer = document.querySelectorAll('.answers-card')

    cardsAnswer.forEach(card => {

      card.addEventListener('click', () => {
        card.classList.toggle("active")
      });
    });

  }
})
