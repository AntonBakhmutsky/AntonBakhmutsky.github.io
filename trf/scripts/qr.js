'use strict'

window.addEventListener('load', () => {
    //show hide qr
    const qr = document.querySelector('.modalQr');
    const qrBtn = document.querySelector('.main__headerQr');
    const cancelBtn = document.querySelector('.modalQr__buttonBtn');
    const body = document.getElementsByTagName('body')[0];

    const toggleQr = () => {
        qr.classList.toggle('modalQr_active');
        body.classList.toggle('body_qr');
    }
    const closeQr = () => {
        qr.classList.remove('modalQr_active');
        body.classList.remove('body_qr');
    }

    qrBtn.addEventListener('click', toggleQr);
    cancelBtn.addEventListener('click', closeQr);
});
