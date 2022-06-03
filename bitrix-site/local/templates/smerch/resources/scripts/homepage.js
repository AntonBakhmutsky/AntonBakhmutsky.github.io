import lottie from 'lottie-web'

window.addEventListener('load', () => {
	// set vh
	let lastWidth = window.innerWidth

	const listener = () => {
		let vh = window.innerHeight * 0.01
		document.documentElement.style.setProperty('--vh', `${vh}px`)
	}

	window.addEventListener('resize', () => {
		if (lastWidth !== window.innerWidth) {
			lastWidth = window.innerWidth
			listener()
		}
	})

	listener()

	// lottie
	const collabsBtn = document.querySelector('.main-nav__item_collabs')
	const apieceBtn = document.querySelector('.main-nav__item_apiece')
	const merchBtn = document.querySelector('.main-nav__item_merch')
	const collabsLink = document.querySelector('.main-nav__item_collabs a')
	const apieceLink = document.querySelector('.main-nav__item_apiece a')
	const merchLink = document.querySelector('.main-nav__item_merch a')

	const collabs = lottie.loadAnimation({
		container: document.querySelector('.lottie__container_collabs'),
		renderer: 'svg',
		autoplay: false,
		path: '/local/templates/smerch/assets/lottie/fireworks.json'
	})

	const apiece = lottie.loadAnimation({
		container: document.querySelector('.lottie__container_apiece'),
		renderer: 'svg',
		autoplay: false,
		path: '/local/templates/smerch/assets/lottie/men.json'
	})

	const merch = lottie.loadAnimation({
		container: document.querySelector('.lottie__container_merch'),
		renderer: 'svg',
		autoplay: false,
		path: '/local/templates/smerch/assets/lottie/smerch.json'
	})

	const merchMobile = lottie.loadAnimation({
		container: document.querySelector('.lottie__mobile_merch'),
		renderer: 'svg',
		autoplay: false,
		path: '/local/templates/smerch/assets/lottie/smerch_mobile.json'
	})

	const collabsMobile = lottie.loadAnimation({
		container: document.querySelector('.lottie__mobile_collabs'),
		renderer: 'svg',
		autoplay: false,
		path: '/local/templates/smerch/assets/lottie/fireworks_mobile.json'
	})

	const apieceMobile = lottie.loadAnimation({
		container: document.querySelector('.lottie__mobile_apiece'),
		renderer: 'svg',
		autoplay: false,
		path: '/local/templates/smerch/assets/lottie/men_mobile.json'
	})

	const checkWidth = (anim) => (window.innerWidth < 1025) ? false : anim.play()

	const mobileAnimation = (event, anim, animMobile) => {
		const winWidth = window.innerWidth
		const href = event.currentTarget.getAttribute('href')

		if (winWidth < 1025) {
			event.preventDefault()

			setTimeout(() => {
				(winWidth < 769) ? animMobile.stop() : anim.stop()
				document.location.href = href
			}, 1500)
		}

		if (winWidth < 769) {
			animMobile.play()
		} else if (winWidth > 769 && winWidth < 1025) {
			anim.play()
		}
	}

	collabsBtn.addEventListener('mouseover', () => checkWidth(collabs))
	collabsBtn.addEventListener('mouseout', () => collabs.stop())
	apieceBtn.addEventListener('mouseover', () => checkWidth(apiece))
	apieceBtn.addEventListener('mouseout', () => apiece.stop())
	merchBtn.addEventListener('mouseover', () =>	checkWidth(merch))
	merchBtn.addEventListener('mouseout', () => merch.stop())
	collabsLink.addEventListener('click', (e) => mobileAnimation(e, collabs, collabsMobile))
	apieceLink.addEventListener('click', (e) => mobileAnimation(e, apiece, apieceMobile))
	merchLink.addEventListener('click', (e) => mobileAnimation(e, merch, merchMobile))
})