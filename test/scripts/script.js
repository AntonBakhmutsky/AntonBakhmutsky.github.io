window.addEventListener('load', () => {
    const btn = document.querySelector('.btn');
    const modal = document.querySelector('.modal');

    const showModal = () => modal.classList.add('active');


    const closeModal = (e) => {
        if (e.target.classList.contains('active')) {
            modal.classList.remove('active');
        }
    }

    btn.addEventListener('click', showModal)
    modal.addEventListener('click', closeModal)
});
