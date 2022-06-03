import rappers from '@/api/rappers'

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
    async fetch ({ commit, rootState }) {
      const { data: { data } } = await rappers.index({
        'sort': 'weight,name',
        'page[all]': 1,
        'filter[publish]': 1,
        'filter[site_version]': rootState.siteVersions.item?.id,
        'fields': 'id,weight,code,nickname,title,image,alt_image'
      })

      commit('SET_ITEMS', data)
    },
    async show ({ commit }, id) {
      commit('SET_ITEM', {})
      const { data: { data } } = await rappers.show(id)
      commit('SET_ITEM', data)
    }
  }
}
