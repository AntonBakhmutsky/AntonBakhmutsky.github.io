window.addEventListener('load', () => {
	if (!document.querySelector('.sizes')) {
		return false
	}

	const sizesBtns = document.querySelectorAll('.sizes__more')

	const toggleHidden = (event) => {
		const hidden = event.currentTarget.parentElement.nextElementSibling

		event.currentTarget.classList.toggle('active')
		hidden.classList.toggle('active')
		hidden.hasAttribute('style') ? hidden.removeAttribute('style') : hidden.style.maxHeight = `${hidden.scrollHeight}px`
	}

	sizesBtns.forEach(el => el.addEventListener('click', toggleHidden))

})
