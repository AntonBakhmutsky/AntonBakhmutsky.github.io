import riders from '@/api/riders'

export default {
  namespaced: true,
  state: {
    category: {},
    discipline: {},
    item: {},
    items: []
  },
  getters: {
    categories: state => state.items
      .map(item => item.category)
      .filter((item, index, self) => item && self.findIndex(temp => temp?.code === item?.code) === index)
      .sort((a, b) => a?.weight > b?.weight ? 1 : -1),
    filteredItemsByCategory: state => state.items
      .filter(item => !state.category?.code || item.category?.code === state.category?.code),
    disciplines: (state, getters) => getters.filteredItemsByCategory
      .map(item => item.discipline)
      .filter((item, index, self) => item && self.findIndex(temp => temp?.code === item?.code) === index)
      .sort((a, b) => a?.name > b?.name ? 1 : -1),
    filteredItems: (state, getters) => getters.filteredItemsByCategory
      .filter(item => !state.discipline?.code || item.discipline?.code === state.discipline?.code)
  },
  mutations: {
    SET_ITEMS (state, items) {
      state.items = items || []
    },
    SET_ITEM (state, item) {
      state.item = item || {}
    },
    SET_CATEGORY (state, category) {
      state.category = category || {}
      state.discipline = {}
    },
    SET_DISCIPLINE (state, discipline) {
      state.discipline = discipline || {}
    }
  },
  actions: {
    async fetch ({ commit, getters, rootState }) {
      const { data: { data } } = await riders.index({
        'sort': 'weight,name',
        'page[all]': 1,
        'filter[publish]': 1,
        'filter[site_version]': rootState.siteVersions.item?.id,
        'fields': 'id,weight,code,name,image,alt_image,category,discipline'
      })

      commit('SET_ITEMS', data)
      commit('SET_CATEGORY', getters.categories[0])
    },
    async show ({ commit }, id) {
      commit('SET_ITEM', {})
      const { data: { data } } = await riders.show(id)
      commit('SET_ITEM', data)
    }
  }
}
