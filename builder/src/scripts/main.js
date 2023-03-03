import ClipboardJS from 'clipboard'

window.addEventListener('load', () => {

  // copy to clipboard
  const btn = document.querySelector('.step__screen-link-btn')
  const btnYes = document.querySelector('.step__screen-btns-yes')
  const btnNo = document.querySelector('.step__screen-btns-no')
  const key = window.location.href.split('#').pop().replace('%', '')
  const field = document.querySelector('#key')
  const screens = document.querySelectorAll('.step__screen')
  field.value = key

  const clipboard = new ClipboardJS('.step__screen-link-btn', {
    text: function (trigger) {
      return field.value
    }
  })

  btn.addEventListener('click', () => {
    screens.forEach(el => el.classList.contains('hidden') ? el.classList.remove('hidden') : el.classList.add('hidden'))
  })

  // user platform
  const userDeviceArray = [
    {device: 'Android', platform: /Android/, link: 'https://play.google.com/store/apps/details?id=org.outline.android.client&pli=1'},
    {device: 'iPhone', platform: /iPhone/, link: 'https://itunes.apple.com/us/app/outline-app/id1356177741'},
    {device: 'iPad', platform: /iPad/, link: 'https://itunes.apple.com/us/app/outline-app/id1356177741'},
    {device: 'Tablet OS', platform: /Tablet OS/, link: 'https://itunes.apple.com/us/app/outline-app/id1356177741'},
    {device: 'Linux', platform: /Linux/, link: 'https://getoutline.org/ru/get-started/#step-3'},
    {device: 'Windows', platform: /Windows NT/, link: 'https://getoutline.org/ru/get-started/#step-3 '},
    {device: 'Macintosh', platform: /Macintosh/, link: 'https://apps.apple.com/us/app/outline-app/id1356178125'}
  ]

  const platform = navigator.userAgent

  function getPlatform() {
    for (let i in userDeviceArray) {
      if (userDeviceArray[i].platform.test(platform)) {
        return userDeviceArray[i].link;
      }
    }
  }

  btnNo.setAttribute('href', getPlatform())
  btnYes.setAttribute('href', `${window.location.origin}${key}`)

})
