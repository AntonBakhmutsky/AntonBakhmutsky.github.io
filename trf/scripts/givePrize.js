window.addEventListener('load', () => {
    //input cancel
    const inputs = document.querySelectorAll('.givePrize__itemInput');
    const cancelations = document.querySelectorAll('.givePrize__itemCross');
    const qrBtn = document.querySelector('.givePrize__qrBtn');
    const submitDiv = document.querySelector('.givePrize__submit');
    const submitBtn = document.querySelector('.givePrize__submitBtn');
    const id = document.querySelector('#id');
    

    const toggleCancel = () => {
        const cancel = event.path[1].childNodes[3];
        const input = event.path[0];
        if (input.value) {
            if (!cancel.classList.contains('givePrize__itemCross_active')) {
                cancel.classList.add('givePrize__itemCross_active');
                submitBtn.removeAttribute('disabled'); 
                submitDiv.classList.add('givePrize__submit_active');                        
            } else if (input.id === 'id') {
                qrBtn.setAttribute('disabled', 'disabled');
            }
        } else {
            cancel.classList.remove('givePrize__itemCross_active');
            qrBtn.removeAttribute('disabled');
            submitDiv.classList.remove('givePrize__submit_active');
        }
    }

    const resetValue = () => {
        const cancel = event.path[0];
        const input = event.path[1].childNodes[1];  
        input.value = '';
        cancel.classList.remove('givePrize__itemCross_active');
        const value = [...inputs].map(el => el.value).join(' ').trim();
        if (!value) {
            qrBtn.removeAttribute('disabled');        
            submitBtn.setAttribute('disabled', 'disabled');
            submitDiv.classList.remove('givePrize__submit_active');                       
        } else if (id.value === '') {
            qrBtn.removeAttribute('disabled');        
        }
    }

    inputs.forEach(el => el.addEventListener('input', toggleCancel));
    cancelations.forEach(el => el.addEventListener('click', resetValue));
});