window.addEventListener('load', () => {
  //faq tabs
  const questions = document.querySelectorAll('.question__head');

  function toggleContent() {
    console.log(this)
    this.closest('.question').classList.toggle('question_active');
    const content = this.closest('.question').children[1];
    (content.style.maxHeight) ? content.style.maxHeight = null : content.style.maxHeight = content.scrollHeight + 'px';
  }

  questions.forEach(el => el.addEventListener('click', toggleContent));
});