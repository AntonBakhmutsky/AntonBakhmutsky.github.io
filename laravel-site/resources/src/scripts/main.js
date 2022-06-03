import {disableBodyScroll, enableBodyScroll} from 'body-scroll-lock'
import axios from "axios"
import inViewport from "./inViewport"
import IMask from "imask"

import Swiper, {Mousewheel, Navigation, Pagination, Thumbs} from 'swiper'

Swiper.use([Mousewheel, Navigation, Thumbs, Pagination])

window.addEventListener('load', () => {
  // header mobile nav
  const menuBtn = document.querySelector('.header__nav-btn')
  const menu = document.querySelector('.menu__mobile')
  const menuContainer = menu.querySelector('.menu__main')

  const toggleMenu = (event) => {
    if (!event.currentTarget.classList.contains('active')) {
      menuBtn.classList.add('active')
      menu.classList.add('active')
      disableBodyScroll(menuContainer)
    } else {
      menuBtn.classList.remove('active')
      menu.classList.remove('active')
      enableBodyScroll(menuContainer)
    }
  }

  menuBtn.addEventListener('click', toggleMenu)

  // header scroll
  const header = document.querySelector('.header')

  const addScrollClass = () => {
    if (window.pageYOffset !== 0 && !header.classList.contains('header_scroll') && window.innerWidth > 1199) {
      header.classList.add('header_scroll')
    }
  }

  addScrollClass()

  window.addEventListener('scroll', () => {
    if (window.pageYOffset === 0 && header.classList.contains('header_scroll')) {
      header.classList.remove('header_scroll')
    } else {
      addScrollClass()
    }
  })

  // tabs
  const tabsContainer = document.querySelector('.tabs')
  if (tabsContainer && tabsContainer.scrollWidth > tabsContainer.offsetWidth) {
    const tabs = document.querySelectorAll('.tabs__item')
    const currentTab = [...tabs].find(el => el.classList.contains('tabs__item_active'))
    const rect = currentTab.getBoundingClientRect()
    const overlay = document.querySelector('.tabs__overlay')
    let winWidth = window.innerWidth
    let scrollWidth
    let maxLeft

    tabsContainer.scrollLeft = rect.x - winWidth / 2 + rect.width / 2

    setOverlay()

    function toggleModifier(modifier, operation) {
      if (operation === 'remove') {
        overlay.classList.remove(`tabs__overlay_${modifier}`)
      } else if (operation === 'add') {
        overlay.classList.add(`tabs__overlay_${modifier}`)
      }
    }

    function setOverlay () {
      scrollWidth = tabsContainer.scrollWidth
      if (scrollWidth === winWidth) {
        toggleModifier('right', 'remove')
        toggleModifier('left', 'remove')
      } else {
        maxLeft = scrollWidth - winWidth
        toggleModifier('right', 'add')
      }
    }

    function toggleOverlay () {
      const left = tabsContainer.scrollLeft
      if (left > 0 && left <= maxLeft - 5) {
        toggleModifier('left', 'add')
        toggleModifier('right', 'add')
      } else if (left > maxLeft - 5) {
        toggleModifier('right', 'remove')
      }  else if (left === 0) {
        toggleModifier('left', 'remove')
      }
    }

    tabsContainer.addEventListener('scroll', toggleOverlay)
    window.addEventListener('resize', () => {
      if (winWidth !== window.innerWidth) {
        winWidth = window.innerWidth
        setOverlay()
      }
    })
  }

  // swiper
  const galleryThumbs = new Swiper('.gallery-thumbs', {
    resizeObserver: true,
    observer: true,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    grabCursor: true,
    preloadImages: true,
    lazy: true,
    slidesPerView: 'auto',
    breakpoints: {
      320: {
        direction: 'horizontal',
        width: 40,
        height: 40,
        spaceBetween: 15,
      },
      1025: {
        direction: 'vertical',
        width: 70,
        height: 70,
        spaceBetween: 27
      }
    }
  })

  if(document.querySelector('.gallery-top')) {
    const sliderMini = document.querySelector('.gallery-thumbs')
    const slider = document.querySelector('.gallery-top')
    const slides = slider.querySelector('.swiper-wrapper').children

    if(slides.length < 2) {
      if (document.querySelector('.gallery-thumbs')) {
        sliderMini.style.display='none'
      }
      slider.classList.add('gallery-top_alone')
    }
  }

  const galleryTop = new Swiper('.gallery-top', {
    spaceBetween: 10,
    resizeObserver: true,
    observer: true,
    preloadImages: true,
    lazy: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    thumbs: {
      swiper: galleryThumbs
    }
  })

  const articles = new Swiper('.articles__cards .swiper-container', {
    spaceBetween: 10,
    resizeObserver: true,
    observer: true,
    preloadImages: true,
    lazy: true,
    pagination: {
      el: '.articles__cards .swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        width: null,
        spaceBetween: 10,
        allowTouchMove: true,
        centeredSlides: true
      },
      1025: {
        slidesPerView: 3,
        width: 850,
        spaceBetween: 15,
        allowTouchMove: true,
      }
    }
  });

  // mini slider not in the modal
  if (document.querySelector('.product-slider')) {
    const slider = document.querySelector('.product-slider')
    const slides = slider.querySelector('.swiper-wrapper').children
    const sliderArrows = slider.querySelectorAll('.swiper-button')
    let productSlider;
    if (slides.length > 5) {
      productSlider = new Swiper('.product-slider', {
        resizeObserver: true,
        spaceBetween: 20,
        observer: true,
        preloadImages: true,
        lazy: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        breakpoints: {
          320: {
            slidesPerView: 'auto',
            spaceBetween: 10
          },
          766: {
            slidesPerView: 4,
            spaceBetween: 20
          },
          1023: {
            slidesPerView: 5
          }
        }
      })
    } else {
      sliderArrows.forEach(el => el.classList.add('swiper-button_disabled'))
    }

    const modalProduct = new Swiper('.modal-product-slider .gallery-top', {
      spaceBetween: 10,
      resizeObserver: true,
      observer: true,
      preloadImages: true,
      lazy: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      thumbs: {
        swiper: galleryThumbs
      }
    })
  }

  // modals
  let modalBtn = document.querySelectorAll('[data-modal]')
  const modals = document.querySelectorAll('.modal')
  const modalCloses = document.querySelectorAll('.modal__close')

  let activeModal

  const toggleModal = (event) => {
    event.stopPropagation()
    const data = event.currentTarget.dataset
    const modal = document.querySelector(`.modal#${data.modal}`)

    activeModal = modal

    if (Object.keys(data).find(el => el === 'title')) {
      modal.querySelector('.form__title').innerHTML = data.title
    }

    if (Object.keys(data).find(el => el === 'id')) {
      modal.querySelector('input[name="product_id"]').value = data.id
    }

    // click on the magnifier
    if (Object.keys(data).find(el => el === 'images')) {

      const gallery = modal.querySelector('.gallery-top')
      const galleryThumb = document.querySelector('.gallery-thumbs')

      let wrappers = modal.querySelectorAll('.swiper-wrapper')
      let arrImages = JSON.parse(data.images)
      let slides = ''

      arrImages.forEach((el, i) => slides += '<div class="swiper-slide"><img src=' + arrImages[i] + '></div>')

      for(let w = 0; w < wrappers.length; w++) {
        wrappers.item(w).innerHTML = slides
      }

      if (galleryTop.wrapperEl) {
        galleryTop.updateSlides()
      }

      if(arrImages.length < 2) {
        if (galleryThumb) {
          galleryThumb.style.display='none'
        }

        gallery.classList.add('gallery-top_alone')
      } else {
        if (galleryThumb) {
          galleryThumb.style.display='block'
        }

        gallery.classList.remove('gallery-top_alone')
      }
    }

    modal.classList.toggle('modal_active')

    if (activeModal) {
      disableBodyScroll(activeModal)
    }
  }

  const closeModal = () => {
    activeModal.classList.remove('modal_active')
    enableBodyScroll(activeModal)
  }

  const closeOverlay = (event) => {
    event.stopPropagation()
    const list = event.target.classList

    if (list.contains('modal')) {
      closeModal()
    }
  }

  modalCloses.forEach(el => el.addEventListener('click', closeModal))
  modals.forEach(el => el.addEventListener('click', closeOverlay))
  modalBtn.forEach(el => el.addEventListener('click', toggleModal))

  // toggle content text
  if (document.querySelector('.content__more')) {
    const contentTxt = document.querySelector('.content__text')
    const contentBtn = document.querySelector('.content__more-btn')

    if (contentTxt.scrollHeight > contentTxt.offsetHeight) {
      contentBtn.parentElement.classList.add('content__more_active')
    }

    const toggleContent = () => {
      if (!contentTxt.hasAttribute('style')) {
        contentTxt.style.maxHeight = `${contentTxt.scrollHeight}px`
        contentBtn.textContent = 'свернуть'
      } else {
        contentTxt.removeAttribute('style')
        contentBtn.textContent = 'читать далее'
      }
    }
    contentBtn.addEventListener('click', toggleContent)
  }

  // cemetery list
  if (document.querySelector('.cemetery-list')) {
    const list = document.querySelector('.cemetery-list')
    const listInner = document.querySelector('.cemetery-list__inner')
    const listBtn = document.querySelector('.cemetery-contacts__btn')
    const listClose = document.querySelector('.cemetery-list__mobile-head-close')

    const openList = () => {
      list.classList.add('cemetery-list_active')
      disableBodyScroll(listInner)
    }

    const closeList = () => {
      list.classList.remove('cemetery-list_active')
      enableBodyScroll(listInner)
    }

    listBtn.addEventListener('click', openList)
    listClose.addEventListener('click', closeList)

    window.addEventListener('resize', closeList)
  }

  // corona message
  if (document.querySelector('.header__message')) {
    const message = document.querySelector('.header__message')
    const messageClose = message.querySelector('.header__message-close')

    const hidMessage = () => message.classList.add('header__message_disabled')

    messageClose.addEventListener('click', hidMessage)
  }

  // cemeteries collection
  if (document.querySelector('.cemeteries')) {
    const btn = document.querySelector('.cemeteries__btn')
    const container = document.querySelector('.cemeteries__collection')
    let viewport = window.innerWidth

    if (container.offsetHeight < container.scrollHeight) {
      btn.classList.remove('cemeteries__btn_disabled')
    }

    const closeHidden = () => {
      container.removeAttribute('style')
      btn.textContent = 'показать ещё'
    }

    const toggleCemeteries = () => {
      if (container.hasAttribute('style')) {
        closeHidden()
      } else {
        container.style.maxHeight = `${container.scrollHeight}px`
        btn.textContent = 'свернуть'
      }
    }

    btn.addEventListener('click', toggleCemeteries)
    window.addEventListener('resize', () => {
      if (window.innerWidth !== viewport) {
        viewport = window.innerWidth
        closeHidden()
        if (window.innerWidth < 577) {
          btn.classList.remove('cemeteries__btn_disabled')
        } else {
          btn.classList.add('cemeteries__btn_disabled')
        }
      }
    })
  }

  // ----------------------------------------- AJAX ------------------------------------------------------

  // product card request
  if (document.querySelector('.card-grid__more')) {
    let cardGrid
    const cardOrArticles = !!document.querySelector('.card-grid')

    if (cardOrArticles) {
      cardGrid = document.querySelector('.card-grid')
    } else {
      cardGrid = document.querySelector('.articles-main__grid')
    }

    const moreContainer = document.querySelector('.card-grid__more')
    const moreBtn = moreContainer.querySelector('a')

    function getCards(event) {
      event.preventDefault()

      axios
        .get(event.currentTarget.getAttribute('href'), {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then((response) => {
          if (response.status === 200) {
            handleResponse(response)
            console.log(response)
          }
        })
        .catch(error => {
          if (error) {
            console.log(error.response.data.errors)
          }
        })
    }

    function handleResponse(responseObject) {
      document.querySelector('.card-grid__more').remove()
      cardGrid.innerHTML += responseObject.data
      if (cardOrArticles) {
        cardGrid.querySelectorAll('.product-card__bottom button').forEach(el => el.addEventListener('click', toggleModal))
        cardGrid.querySelectorAll('.product-card__image').forEach(el => el.setAttribute('data-modal', 'modal-product-card'))
        cardGrid.querySelectorAll('.product-card__image').forEach(el => el.addEventListener('click', toggleModal))
      }
      if (cardGrid.querySelector('.card-grid__more a')) {
        cardGrid.querySelector('.card-grid__more a').addEventListener('click', getCards)
      }
    }
    moreBtn.addEventListener('click', getCards)
  }

  // form request
  const formBtns = document.querySelectorAll('.form__submit')
  const phoneFields = document.querySelectorAll('input[name="phone"]')
  const nameFields = document.querySelectorAll('input[name="name"]')

  phoneFields.forEach(el => {
    const mask = IMask(el, {mask: '0(000)000-00-00'})
  })
  nameFields.forEach(el => IMask(el, {mask: /^[\p{L}\p{M}\-\. ]+$/u}))

  function sendRequest(event) {
    event.preventDefault()
    const form = event.currentTarget.closest('form')
    const formResponse = form.querySelector('.form__response')

    let formData = new FormData(form)

    axios
      .post(form.action, formData, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then((response) => {
        if (response.status === 200) {
          formResponse.classList.add('form__response_active')

          setTimeout(() => {
            formResponse.classList.remove('form__response_active')
            form.reset()
            form.querySelectorAll('.form__input').forEach(el => el.classList.remove('form__input_error'))
            if (form.closest('.modal')) {
              const modal = form.closest('.modal')
              modal.classList.remove('modal_active')
              enableBodyScroll(modal)
            }
          }, 10000)
        }
      })
      .catch(error => {
        if (error) {
          const errorsData = error.response.data.errors
          for (const key in errorsData) {
            const errorField = form.querySelector(`input[name=${key}]`).parentElement.classList
            const errorMessageField = form.querySelector(`input[name=${key}]`).nextElementSibling
            const message = errorsData[key][0]

            errorMessageField.textContent = message
            errorField.add('form__input_error')

          }
        }
      })
  }

  formBtns.forEach(el => el.addEventListener('click', sendRequest))

  // body preload
  document.querySelector('body').removeAttribute('class')

  //----------------------------------------------------------- lazyload ------------------------------------------------
  const lazyload = document.querySelectorAll('.lazyload')

  lazyload.forEach((element) => {
    inViewport(element, () => {
      const src = element.dataset.src
      const srcset = element.dataset.srcset

      if (src) {
        element.setAttribute('src', src)
        element.removeAttribute('data-src')
      } else if(srcset) {
        element.setAttribute('srcset', srcset)
        element.removeAttribute('data-srcset')
      }

      element.dataset.lazyloaded = 'true'
    }, 'offset')
  })
})
