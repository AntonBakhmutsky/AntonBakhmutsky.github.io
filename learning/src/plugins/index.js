const plugins = [
  'filters',
  'hammer',
  'lazyload',
  'meta',
  'modals',
  'veeValidate',
  'ym'
]

plugins.forEach((file) => {
  require(`./${file}`)
})
