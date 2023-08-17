window.addEventListener('load', () => {
  if (document.querySelector('.news')) {

    const titleElements = document.querySelectorAll('.news-title');

    titleElements.forEach(function(titleElement) {
      const maxHeight = parseFloat(getComputedStyle(titleElement).getPropertyValue('line-height')) * 3; // Calculate max height for 3 lines
      if (titleElement.scrollHeight > maxHeight) {
        const truncatedText = titleElement.textContent.slice(0, -3) + '...';
        titleElement.textContent = truncatedText;
      }
    });


  }
})
