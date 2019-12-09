window.addEventListener('load', () => {
    //partners or faq or support
    const buttons = document.querySelectorAll('.tab__btn');
    const partnersBtn = document.querySelector('#partners');
    const faqBtn = document.querySelector('#faq');
    const supportBtn = document.querySelector('#support');
    const partners = document.querySelector('.partners');
    const faq = document.querySelector('.faq');
    const support = document.querySelector('.support');
    const main = document.querySelector('.main');
    const pageBloks = [partners, faq, support];

    const showPartners = () => {
        if (partnersBtn.classList.contains('tab__btn_gradientTheme')) {
            buttons.forEach(el => el.classList.remove('tab__btn_active_gradientTheme'));
        } else {
            buttons.forEach(el => {
                el.classList.add('tab__btn_gradientTheme');
                el.classList.remove('tab__btn_active');
            });
            main.classList.add('main_gradientTheme');     
        }
        partnersBtn.classList.add('tab__btn_active_gradientTheme');
        pageBloks.forEach(el => el.classList.remove(el.classList[0] + '_active'));
        partners.classList.add('partners_active');
    }
    const showFaq = () => {
        if (faqBtn.classList.contains('tab__btn_gradientTheme')) {
            buttons.forEach(el => el.classList.remove('tab__btn_active_gradientTheme', 'tab__btn_gradientTheme'));
            main.classList.remove('main_gradientTheme');
        } 
        faqBtn.classList.add('tab__btn_active');
        pageBloks.forEach(el => el.classList.remove(el.classList[0] + '_active'));
        faq.classList.add('faq_active');
    }
    const showSupport = () => {
        if (supportBtn.classList.contains('tab__btn_gradientTheme')) {
            buttons.forEach(el => el.classList.remove('tab__btn_active_gradientTheme'));
        } else {
            buttons.forEach(el => {
                el.classList.add('tab__btn_gradientTheme');
                el.classList.remove('tab__btn_active');
            });
            main.classList.add('main_gradientTheme');     
        }
        supportBtn.classList.add('tab__btn_active_gradientTheme');
        pageBloks.forEach(el => el.classList.remove(el.classList[0] + '_active'));
        support.classList.add('support_active');
    }

    partnersBtn.addEventListener('click', showPartners);
    faqBtn.addEventListener('click', showFaq);
    supportBtn.addEventListener('click', showSupport);

    //transition to create ticket 
    const ticketBtn = document.querySelector('.createTicket__btn');
    const ticketForm = document.querySelector('.createTicket__form');
    const ticketCancel = document.querySelector('.createTicket__formSubmitItem:nth-child(2)');

    const showForm  = (event) => {
        event.preventDefault();
        ticketBtn.classList.add('createTicket__btn_disabled');
        ticketForm.classList.remove('createTicket__form_disabled');
    }
    const cancelTicket = (event) => {
        event.preventDefault();
        ticketBtn.classList.remove('createTicket__btn_disabled');
        ticketForm.classList.add('createTicket__form_disabled');
    }

    ticketBtn.addEventListener('click', showForm);
    ticketCancel.addEventListener('click', cancelTicket);

    // open question
    const buttonArray = document.querySelectorAll('.popularQuestions__answerMore');

    function toggleContent() {
        this.classList.toggle('popularQuestions__answerMore_active');
        const content = this.closest('.popularQuestions__answerContainer').childNodes[3];
        (content.style.maxHeight) ? content.style.maxHeight = null : content.style.maxHeight = content.scrollHeight + 'px';
    }

    buttonArray.forEach(el => el.addEventListener('click', toggleContent));
});