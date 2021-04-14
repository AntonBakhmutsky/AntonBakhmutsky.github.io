const plugins = [
  'lazyload',
  'viewportUnitsBuggyfill'
]

plugins.forEach((file) => {
  require(`./${file}`)
})
