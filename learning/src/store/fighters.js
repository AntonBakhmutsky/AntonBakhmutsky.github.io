import fighters from '@/api/fighters'
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
      const { data: { data } } = await fighters.index({
        'sort': 'weight,name',
        'page[all]': 1,
        'filter[publish]': 1,
        'filter[locale]': i18n.locale,
        'fields': 'id,weight,code,name,nickname,title,image,alt_image,category'
      })
      commit('SET_ITEMS', data)
    },
    async show ({ commit }, id) {
      commit('SET_ITEM', {})
      const { data: { data } } = await fighters.show(id)
      commit('SET_ITEM', data)
    },
    async showByCode ({ commit }, code) {
      commit('SET_ITEM', {})

      const { data: { data } } = await fighters.index({
        'filter[code]': code,
        'page[size]': 1
      })

      if (!data.length) {
        throw new Error('Not Found')
      }

      commit('SET_ITEM', data[0])
    }
  }
}
