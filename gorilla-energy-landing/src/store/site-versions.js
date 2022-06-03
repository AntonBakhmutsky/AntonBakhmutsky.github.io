import siteVersions from '@/api/site-versions'

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
      const { data: { data } } = await siteVersions.index({
        'page[all]': 1,
        'filter[publish]': 1,
        'sort': 'weight',
        'fields': 'id,code,name,locales'
      })

      commit('SET_ITEMS', data)
    }
  }
}
