const plugins = [
  'viewportUnitsBuggyfill'
]

plugins.forEach((file) => {
  require(`./${file}`)
})
