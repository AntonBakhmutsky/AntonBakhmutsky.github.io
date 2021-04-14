import socials from '@/api/socials'
import i18n from '@/plugins/i18n'

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
    async fetch ({ commit }) {
      const { data: { data } } = await socials.index({
        'sort': '-date',
        'page[size]': 9,
        'filter[publish]': 1,
        'filter[locale]': i18n.locale,
        'fields': 'id,code,date,link,image'
      })
      commit('SET_ITEMS', data)
    }
  }
}
