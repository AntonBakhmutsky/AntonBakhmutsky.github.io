import socials from '@/api/socials'

export default {
  namespaced: true,
  state: {
    items: []
  },
  mutations: {
    SET_ITEMS (state, items) {
      state.items = items || []
    }
  },
  actions: {
    async fetch ({ commit, rootState }) {
      const { data: { data } } = await socials.index({
        'sort': '-date',
        'page[size]': 9,
        'filter[publish]': 1,
        'filter[site_version]': rootState.siteVersions.item?.id,
        'fields': 'id,code,date,link,image'
      })

      commit('SET_ITEMS', data)
    }
  }
}
