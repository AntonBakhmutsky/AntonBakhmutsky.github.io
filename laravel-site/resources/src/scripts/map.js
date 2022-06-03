import * as L from "leaflet"
import {GestureHandling} from "leaflet-gesture-handling"

import "leaflet/dist/leaflet.css"
import "leaflet-gesture-handling/dist/leaflet-gesture-handling.css"
import inViewport from "./inViewport"
import "./leaflet-providers"


const section = document.querySelector('.map')

inViewport(section, () => {
  L.Map.addInitHook("addHandler", "gestureHandling", GestureHandling)

  const mapOptions = JSON.parse(section.dataset.options)
  const markerData = JSON.parse(section.dataset.marker)
  const apiKey = 'ygz9eBGR_HgzaMmDcGCPa7xt_rSNpK-cUtqpp3YtDks';

  const map = L.map(section, {
    center: [mapOptions.lat, mapOptions.lng],
    zoomControl: false,
    attributionControl: false,
    zoom: mapOptions.zoom,
    gestureHandling: true
  })

  L.tileLayer.provider('HEREv3.terrainDay', {
    apiKey: apiKey
  }).addTo(map)

  const marker = L.icon({
    iconUrl: markerData.iconUrl,
    iconSize: markerData.iconSize,
    iconAnchor: markerData.iconAnchor
  })

  L.marker([markerData.lat, markerData.lng], {icon: marker}).addTo(map).bindPopup(markerData.title)
})

