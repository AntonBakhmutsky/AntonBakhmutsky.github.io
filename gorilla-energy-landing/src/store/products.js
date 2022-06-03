import products from '@/api/products'

export default {
  namespaced: true,
  state: {
    item: {},
    items: [],
    type: null
  },
  mutations: {
    SET_ITEMS (state, items) {
      state.items = items || []
    },
    SET_ITEM (state, item) {
      state.item = item || {}
    },
    SET_TYPE (state, type) {
      state.type = type
    }
  },
  actions: {
    async fetch ({ commit, state, rootState }) {
      const { data: { data } } = await products.index({
        'sort': 'weight',
        'page[all]': 1,
        'filter[publish]': 1,
        'filter[site_version]': rootState.siteVersions.item?.id,
        'filter[type]': state.type,
        'fields': 'id,weight,code,name,description,composition,nutritional'
      })

      commit('SET_ITEMS', data)
      commit('SET_ITEM', data[0])
    }
  }
}
