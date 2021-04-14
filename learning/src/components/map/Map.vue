<template lang="pug">
  section.map#map
    .map__container(ref="map")
    .hidden
      MapPopup(ref="popup")
    .container
      MapTitle(v-show="!headerHide")
      MapSelects(v-show="!headerHide")
      MapControls(
        ref="controls"
        :max="map && map.getZoom() === this.maxZoom"
        :min="map && map.getZoom() === this.minZoom"
      )
</template>

<script>
/* eslint-disable no-undef */
import { mapActions, mapState, mapMutations, mapGetters } from 'vuex'
import inViewport from '@/helpers/inViewport'

import { Loader } from '@googlemaps/js-api-loader'
import MarkerClusterer from '@googlemaps/markerclustererplus'

import MapTitle from '@/components/map/MapTitle'
import SelectFilter from '@/components/forms/SelectFilter'
import MapPopup from '@/components/map/MapPopup'
import MapControls from '@/components/map/MapControls'
import MapSelects from '@/components/map/MapSelects'

export default {
  name: 'Map',
  data: () => ({
    map: null,
    activeInfoWindow: false,
    headerHide: false
  }),
  computed: {
    ...mapState('map', ['maxZoom', 'minZoom', 'styles']),
    ...mapGetters('map', ['filteredItems'])
  },
  components: {
    MapSelects,
    MapControls,
    MapPopup,
    SelectFilter,
    MapTitle
  },
  watch: {
    filteredItems () {
      this.initCluster()
    }
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, this.fetch, 'offset')
      this.initMap()
    })
  },
  methods: {
    ...mapActions('map', ['fetch']),
    ...mapMutations('map', ['SET_ITEM']),
    async initMap () {
      let language = 'en'

      switch (this.$i18n.locale) {
        case 'ru':
        case 'by':
          language = 'ru'
          break
        case 'ua':
          language = 'uk'
          break
        case 'kz':
          language = 'kk'
          break
      }

      const loader = new Loader({
        apiKey: process.env.VUE_APP_GOOGLE_MAPS_API_KEY,
        version: 'weekly',
        language
      })

      await loader.load()

      this.map = new google.maps.Map(this.$refs.map, {
        center: { lat: 0, lng: 0 },
        zoom: 5,
        disableDefaultUI: true,
        scrollwheel: false,
        maxZoom: this.maxZoom,
        minZoom: this.minZoom,
        styles: this.styles
      })

      this.$refs.controls.$refs.plus.addEventListener('click', () => this.map.setZoom(this.map.getZoom() + 1))
      this.$refs.controls.$refs.minus.addEventListener('click', () => this.map.setZoom(this.map.getZoom() - 1))
    },
    initCluster () {
      const markers = this.filteredItems.map((item) => {
        const marker = new google.maps.Marker({
          position: new google.maps.LatLng(...item.coordinates.split(',')),
          icon: {
            url: require('@/assets/img/map/map_marker.png'),
            size: new google.maps.Size(90, 105),
            anchor: new google.maps.Point(45, 80)
          }
        })

        const infoWindow = new google.maps.InfoWindow({
          content: this.$refs.popup.$el,
          minWidth: 320
        })

        infoWindow.addListener('domready', () => document.querySelector('.gm-ui-hover-effect').remove())

        marker.addListener('click', () => {
          this.SET_ITEM(item)
          this.openInfoWindow(infoWindow, map, marker)
        })

        this.$refs.popup.$refs.close.addEventListener('click', () => this.closeInfoWindow())
        this.map.addListener('click', () => this.closeInfoWindow())

        return marker
      })

      const cluster = new MarkerClusterer(this.map, markers, {
        averageCenter: true,
        maxZoom: this.maxZoom,
        styles: [{
          url: require('@/assets/img/map/map_marker.png'),
          width: 90,
          height: 105,
          anchorText: [40, 0],
          anchorIcon: [80, 45],
          textColor: '#ffb612',
          textSize: 13,
          textLineHeight: 22,
          fontFamily: 'DirtyHeadlineCyrillic, sans-serif'
        }]
      })

      cluster.fitMapToMarkers(20)
    },
    closeInfoWindow () {
      if (this.activeInfoWindow) {
        this.activeInfoWindow.close()
        if (window.innerWidth > 1024) {
          this.headerHide = false
        }
      }
    },
    openInfoWindow (infoWindow, map, marker) {
      this.closeInfoWindow()
      infoWindow.open(map, marker)
      this.activeInfoWindow = infoWindow
      if (window.innerWidth > 1024) {
        this.headerHide = true
      }
    }
  }
}
</script>
