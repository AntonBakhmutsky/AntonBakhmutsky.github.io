window.addEventListener('load', () => {
  if (document.querySelector('.docs')) {

    const docsCards = document.querySelectorAll('.docs-card');
    const docsModalOverlay = document.querySelector('.docs-modal-overlay');
    const docsModal = document.querySelector('.docs-modal');
    const closeButton = document.querySelector('.close-button');

    docsCards.forEach(docsCard => {
      const expandButton = docsCard.querySelector('.expand-button');
      const docsCardOverlay = docsCard.querySelector('.docs-card-overlay');

      expandButton.addEventListener('click', () => {
        docsModal.innerHTML = docsCard.innerHTML;
        docsModalOverlay.classList.add("active")
      });

      docsCardOverlay.addEventListener('click', event => {
        event.stopPropagation();
      });

      docsCard.addEventListener('click', () => {
        docsModal.innerHTML = docsCard.innerHTML;
        docsModalOverlay.classList.add("active")
      });
    });

    docsModalOverlay.addEventListener('click', () => {
      docsModalOverlay.classList.remove("active")
    });

    closeButton.addEventListener('click', () => {
      docsModalOverlay.classList.remove("active")
    });


  }
})
