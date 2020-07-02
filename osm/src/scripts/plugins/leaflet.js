import L from 'leaflet'

// webpack load marker icons

delete L.Icon.Default.prototype._getIconUrl

L.Icon.Default.mergeOptions({
  iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
  iconUrl: require('leaflet/dist/images/marker-icon.png'),
  shadowUrl: require('leaflet/dist/images/marker-shadow.png')
})

// mapbox access token

const accessToken = process.env.MAPBOX_ACCESS_TOKEN

// first map
const mapBoxUrlFirst = `https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=${accessToken}`


const mapFirst = L.map('map-first').setView([51.505, -0.09], 13)

L.tileLayer(mapBoxUrlFirst, {
  id: 'mapbox/streets-v11',
  tileSize: 512,
  style: '//styles/n-tano/ckblxrg2c0vzd1iph279xsw8m/draft',
  zoomOffset: -1
}).addTo(mapFirst)

L.marker([51.5, -0.09]).addTo(mapFirst)

// second map

const mapBoxUrlSecond = `https://api.mapbox.com/styles/v1/tarhanov/ck9wyi4ee0wx11in1rvoyzkki/tiles/256/{z}/{x}/{y}@2x?access_token=${accessToken}`

const mapSecond = L.map('map-second').setView([51.505, -0.09], 13)

L.tileLayer(mapBoxUrlSecond).addTo(mapSecond)

L.marker([51.5, -0.09]).addTo(mapSecond)
