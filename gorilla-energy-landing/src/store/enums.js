import enums from '@/api/enums'

export default {
  namespaced: true,
  state: {
    productTypes: []
  },
  mutations: {
    SET_PRODUCT_TYPES (state, types) {
      state.productTypes = types || []
    }
  },
  actions: {
    async fetch ({ commit }) {
      const { data } = await enums.index()

      const defaultProductType = data?.productTypes
        ?.find(item => item.key.toLowerCase())
        ?.value

      commit('SET_PRODUCT_TYPES', data?.productTypes)
      commit('products/SET_TYPE', defaultProductType, { root: true })
    }
  }
}
