window.addEventListener('load', () => {
    // open content
    const buttonArray = document.querySelectorAll('.notifications__bodyItemMore');

    function toggleContent() {
        this.classList.toggle('notifications__bodyItemMore_active');
        const content = this.closest('.notifications__bodyItem').childNodes[5];
        (content.style.maxHeight) ? content.style.maxHeight = null : content.style.maxHeight = content.scrollHeight + 'px';
    }

    buttonArray.forEach(el => el.addEventListener('click', toggleContent));
});