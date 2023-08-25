window.addEventListener('load', () => {
  if (document.querySelector('.reviews-main')) {

    const reviewsCards = document.querySelectorAll('.reviews-main-card')

    reviewsCards.forEach(card => {
      const btn = card.querySelector('.expand-btn')
      const reviewsText = card.querySelector('.reviews_text')
      const textHeight = reviewsText.clientHeight
      const lineHeight = parseInt(window.getComputedStyle(reviewsText).lineHeight)
      const numberOfLines = textHeight / lineHeight

      if (numberOfLines < 6) {
        card.classList.add('active')
        btn.style.display = 'none'
      }

      btn.addEventListener('click', () => {
        card.classList.toggle('active')
        btn.textContent = card.classList.contains('active') ? 'Свернуть' : 'Развернуть'
      });
    });
  }
});



