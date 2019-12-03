window.addEventListener('load', () => {
    // toggle trouble area
    const openBtn = document.querySelector('.trouble__open');
    const form = document.querySelector('.trouble__form');

    const toggleForm = () => {
        openBtn.classList.toggle('trouble__open_active');
        form.classList.toggle('trouble__form_active');
    }

    openBtn.addEventListener('click', toggleForm);
});