import news from '@/api/news'
import i18n from '@/plugins/i18n'

export default {
  namespaced: true,
  state: {
    size: 8,
    page: 1,
    category: {},
    categories: [],
    item: {},
    items: [],
    meta: {}
  },
  getters: {
    hasMore: state => state.page < state.meta?.last_page
  },
  mutations: {
    SET_ITEMS (state, items) {
      state.items = items || []
    },
    SET_META (state, meta) {
      state.meta = meta || {}
    },
    SET_PAGE (state, page) {
      state.page = page || 1
    },
    ADD_ITEMS (state, items) {
      state.items.push(...items)
    },
    SET_ITEM (state, item) {
      state.item = item || {}
    },
    SET_CATEGORY (state, category) {
      state.category = category || {}
    },
    SET_CATEGORIES (state, categories) {
      state.categories = categories || []
    }
  },
  actions: {
    async fetch ({ commit, state, rootState }, type = null) {
      if (type) {
        commit('SET_PAGE', state.page + 1)
      } else {
        commit('SET_ITEMS', [])
        commit('SET_PAGE', 1)
      }

      const { data } = await news.index({
        'sort': '-date',
        'page[size]': state.size,
        'page[number]': state.page,
        'filter[publish]': 1,
        'filter[site_version]': rootState.siteVersions.item?.id,
        'filter[category]': state.category?.id,
        'fields': 'id,code,date,external_link,name,preview_image,preview_text,category'
      })

      if (type) {
        commit('ADD_ITEMS', data.data)
      } else {
        commit('SET_ITEMS', data.data)
      }

      commit('SET_META', data.meta)
    },
    async show ({ commit }, id) {
      commit('SET_ITEM', {})
      const { data: { data } } = await news.show(id)
      commit('SET_ITEM', data)
    },
    async fetchCategories ({ commit }) {
      const { data } = await news.categories({
        'sort': 'name',
        'page[all]': 1,
        'filter[publish]': 1,
        'filter[locale]': i18n.locale,
        'fields': 'id,code,name'
      })

      commit('SET_CATEGORIES', data.data)
    }
  }
}
