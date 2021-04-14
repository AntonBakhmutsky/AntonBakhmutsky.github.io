export default function (router, middlewares = []) {
  middlewares.forEach((file) => {
    require(`./${file}`).default(router)
  })
}
