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
    //delete team modal
    const hintModal = document.querySelector('.hint__modal');
    const team = document.querySelector('.deleteTeam');
    const person = document.querySelector('.deletePerson');

    const deleteTeam = document.querySelector('.team__delete');
    const deletePerson = document.querySelector('.team__deletePerson');

    const showHintModalP = () => {
        hintModal.style.display = 'flex';
        team.style.display = 'none';
        person.style.display = 'flex';
    }
    const showHintModalT = () => {
        hintModal.style.display = 'flex';
        person.style.display = 'none';
        team.style.display = 'flex';
    }
    const closeHintModal = () => {
        const list = event.target.classList;
        if (list.contains('hint__modal') || list.contains('modal__close') || list.contains('modal__cancel')) {
            hintModal.removeAttribute('style');
        }
    }

    deletePerson.addEventListener('click', showHintModalP);
    deleteTeam.addEventListener('click', showHintModalT);
    hintModal.addEventListener('click', closeHintModal);
});

















