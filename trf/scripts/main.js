$('.galery_slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.galery_slider_nav'
});
$('.galery_slider_nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.galery_slider',
    centerMode: true,
    focusOnSelect: true
});
$('.galery_slider_2').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true
});

window.addEventListener('load', () => {
    //hint modal
    const hintModal = document.querySelector('.hint__modal');
    const buyBtn = document.querySelector('.hint__buyBtn');

    const showHintModal = () => {
        hintModal.style.display = 'flex';
    }
    const closeHintModal = () => {
        const list = event.target.classList;
        if (list.contains('hint__modal') || list.contains('modal__close') || list.contains('modal__cancel')) {
            hintModal.removeAttribute('style');
        }
    }

    buyBtn.addEventListener('click', showHintModal);
    hintModal.addEventListener('click', closeHintModal);
});

window.addEventListener('load', () => {
    //team modal
    const hintModal = document.querySelector('.hint__modal');
    const deleteBtn = document.querySelector('.team__delete');

    const showHintModal = () => {
        hintModal.style.display = 'flex';
    }
    const closeHintModal = () => {
        const list = event.target.classList;
        if (list.contains('hint__modal') || list.contains('modal__close') || list.contains('modal__cancel')) {
            hintModal.removeAttribute('style');
        }
    }

    deleteBtn.addEventListener('click', showHintModal);
    hintModal.addEventListener('click', closeHintModal);
});

















