window.addEventListener('load', () => {
  if (!document.querySelector('.notice')) {
    return null
  } else {

    const toggleBtn = document.querySelector('.notice-main-message-title__toggle');
    const notice = document.querySelector('.notice-main-message')



    function changeStyles(container, button) {
      container.classList.remove('notice-main-message-unread');
      container.querySelector('.notice-main-message-title').classList.remove('notice-main-message-unread-title');
      container.querySelector('.notice-main-message-title-short').classList.remove('notice-main-message-unread-title-short');
      container.querySelector('.notice-main-message-title-info__indicator').classList.remove('notice-main-message-unread-title-info__indicator');
      container.querySelector('.notice-main-message-title-info__text').classList.remove('notice-main-message-unread-title-info__text');
      container.querySelector('.notice-main-message-title__toggle').classList.remove('notice-main-message-unread-title__toggle');
      const messageContent = container.querySelector('.notice-main-message-content')
      const messageShort = container.querySelector('.notice-main-message-title-short')
      button.classList.toggle('notice-main-message-title__toggle-open');
      messageContent.classList.toggle('block');
      messageShort.classList.toggle('none');

    }

// Получаем все дивы с классом "notice-main-message-unread"
    var divs = document.querySelectorAll('.notice-main-message-unread');

// Применяем обработчик событий к каждому диву
    divs.forEach(function(div) {
      const button = div.querySelector('.notice-main-message-title__toggle');
      button.addEventListener('click', function(event) {
        const container = event.target.closest('.notice-main-message');
        changeStyles(container, button);
      });
    });

  }
});
