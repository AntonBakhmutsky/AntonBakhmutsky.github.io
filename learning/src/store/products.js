import products from '@/api/products'
import i18n from '@/plugins/i18n'

export default {
  namespaced: true,
  state: {
    item: {},
    items: []
  },
  mutations: {
    SET_ITEMS (state, items) {
      state.items = items || []
    },
    SET_ITEM (state, item) {
      state.item = item || {}
    }
  },
  actions: {
    async fetch ({ commit }) {
      const { data: { data } } = await products.index({
        'sort': 'weight',
        'page[all]': 1,
        'filter[publish]': 1,
        'filter[locale]': i18n.locale,
        'fields': 'id,weight,code,name,description,composition'
      })
      commit('SET_ITEMS', data)
      commit('SET_ITEM', data[0])
    }
  }
}
