import cities from '@/api/cities'

export default {
  namespaced: true,
  state: {
    city: {},
    country: {},
    item: {},
    items: [],
    maxZoom: 12,
    minZoom: 3,
    styles: [
      {
        'featureType': 'landscape.man_made',
        'elementType': 'all',
        'stylers': [{ 'hue': '#9eff00' }, { 'saturation': 100 }, { 'lightness': '-61' }, { 'visibility': 'on' }]
      },
      {
        'featureType': 'landscape.natural',
        'elementType': 'all',
        'stylers': [{ 'hue': '#9eff00' }, { 'saturation': 100 }, { 'lightness': '-61' }, { 'visibility': 'on' }]
      },
      {
        'featureType': 'poi',
        'elementType': 'all',
        'stylers': [{ 'hue': '#9eff00' }, { 'saturation': 100 }, { 'lightness': '-61' }, { 'visibility': 'on' }]
      },
      {
        'featureType': 'road',
        'elementType': 'all',
        'stylers': [{ 'hue': '#002C0A' }, { 'saturation': 100 }, { 'lightness': -87 }, { 'visibility': 'on' }]
      },
      {
        'featureType': 'water',
        'elementType': 'all',
        'stylers': [{ 'hue': '#001204' }, { 'saturation': 100 }, { 'lightness': -95 }, { 'visibility': 'on' }]
      }
    ]
  },
  getters: {
    countries: (state) => state.items
      .map(item => item.country)
      .filter((item, index, self) => item && self.findIndex(temp => temp?.code === item?.code) === index)
      .sort((a, b) => a?.name > b?.name ? 1 : -1),
    cities: state => state.items
      .filter(item => !state.country?.code || item.country?.code === state.country?.code),
    filteredItems: (state, getters) => getters.cities
      .filter(item => !state.city?.code || item.code === state.city?.code)
  },
  mutations: {
    SET_ITEMS (state, items) {
      state.items = items || []
    },
    SET_ITEM (state, item) {
      state.item = item || {}
    },
    SET_CITY (state, city) {
      state.city = city || {}
    },
    SET_COUNTRY (state, country) {
      state.country = country || {}
      state.city = {}
    }
  },
  actions: {
    async fetch ({ commit }) {
      const { data: { data } } = await cities.index({
        'sort': 'name',
        'page[all]': 1,
        'filter[publish]': 1,
        'fields': 'id,code,name,coordinates,country,description'
      })
      commit('SET_ITEMS', data)
    }
  }
}
