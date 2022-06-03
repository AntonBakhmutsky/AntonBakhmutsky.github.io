(function (root, factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as an anonymous module.
		define(['leaflet'], factory);
	} else if (typeof modules === 'object' && module.exports) {
		// define a Common JS module that relies on 'leaflet'
		module.exports = factory(require('leaflet'));
	} else {
		// Assume Leaflet is loaded into global object L already
		factory(L);
	}
}(this, function (L) {
	'use strict';

	L.TileLayer.Provider = L.TileLayer.extend({
		initialize: function (arg, options) {
			var providers = L.TileLayer.Provider.providers;

			var parts = arg.split('.');

			var providerName = parts[0];
			var variantName = parts[1];

			if (!providers[providerName]) {
				throw 'No such provider (' + providerName + ')';
			}

			var provider = {
				url: providers[providerName].url,
				options: providers[providerName].options
			};

			// overwrite values in provider from variant.
			if (variantName && 'variants' in providers[providerName]) {
				if (!(variantName in providers[providerName].variants)) {
					throw 'No such variant of ' + providerName + ' (' + variantName + ')';
				}
				var variant = providers[providerName].variants[variantName];
				var variantOptions;
				if (typeof variant === 'string') {
					variantOptions = {
						variant: variant
					};
				} else {
					variantOptions = variant.options;
				}
				provider = {
					url: variant.url || provider.url,
					options: L.Util.extend({}, provider.options, variantOptions)
				};
			}

			// replace attribution placeholders with their values from toplevel provider attribution,
			// recursively
			var attributionReplacer = function (attr) {
				if (attr.indexOf('{attribution.') === -1) {
					return attr;
				}
				return attr.replace(/\{attribution.(\w*)\}/g,
					function (match, attributionName) {
						return attributionReplacer(providers[attributionName].options.attribution);
					}
				);
			};
			provider.options.attribution = attributionReplacer(provider.options.attribution);

			// Compute final options combining provider options with any user overrides
			var layerOpts = L.Util.extend({}, provider.options, options);
			L.TileLayer.prototype.initialize.call(this, provider.url, layerOpts);
		}
	});

	/**
	 * Definition of providers.
	 * see http://leafletjs.com/reference.html#tilelayer for options in the options map.
	 */

	L.TileLayer.Provider.providers = {
		OpenStreetMap: {
			url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
			options: {
				maxZoom: 19,
				attribution:
					'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			},
			variants: {
				Mapnik: {},
				DE: {
					url: 'https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png',
					options: {
						maxZoom: 18
					}
				},
				CH: {
					url: 'https://tile.osm.ch/switzerland/{z}/{x}/{y}.png',
					options: {
						maxZoom: 18,
						bounds: [[45, 5], [48, 11]]
					}
				},
				France: {
					url: 'https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
					options: {
						maxZoom: 20,
						attribution: '&copy; OpenStreetMap France | {attribution.OpenStreetMap}'
					}
				},
				HOT: {
					url: 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
					options: {
						attribution:
							'{attribution.OpenStreetMap}, ' +
							'Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> ' +
							'hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
					}
				},
				BZH: {
					url: 'https://tile.openstreetmap.bzh/br/{z}/{x}/{y}.png',
					options: {
						attribution: '{attribution.OpenStreetMap}, Tiles courtesy of <a href="http://www.openstreetmap.bzh/" target="_blank">Breton OpenStreetMap Team</a>',
						bounds: [[46.2, -5.5], [50, 0.7]]
					}
				}
			}
		},
		HEREv3: {
			/*
			 * HERE maps API Version 3.
			 * These basemaps are free, but you need an API key. Please sign up at
			 * https://developer.here.com/plans
			 * Version 3 deprecates the app_id and app_code access in favor of apiKey
			 *
			 * Supported access methods as of 2019/12/21:
			 * @see https://developer.here.com/faqs#access-control-1--how-do-you-control-access-to-here-location-services
			 */
			url:
				'https://{s}.{base}.maps.ls.hereapi.com/maptile/2.1/' +
				'{type}/{mapID}/{variant}/{z}/{x}/{y}/{size}/{format}?' +
				'apiKey={apiKey}&lg={language}',
			options: {
				attribution:
					'Map &copy; 1987-' + new Date().getFullYear() + ' <a href="http://developer.here.com">HERE</a>',
				subdomains: '1234',
				mapID: 'newest',
				apiKey: '<insert your apiKey here>',
				base: 'base',
				variant: 'normal.day',
				maxZoom: 20,
				type: 'maptile',
				language: 'rus',
				format: 'png8',
				size: '256'
			},
			variants: {
				normalDay: 'normal.day',
				normalDayCustom: 'normal.day.custom',
				normalDayGrey: 'normal.day.grey',
				normalDayMobile: 'normal.day.mobile',
				normalDayGreyMobile: 'normal.day.grey.mobile',
				normalDayTransit: 'normal.day.transit',
				normalDayTransitMobile: 'normal.day.transit.mobile',
				normalNight: 'normal.night',
				normalNightMobile: 'normal.night.mobile',
				normalNightGrey: 'normal.night.grey',
				normalNightGreyMobile: 'normal.night.grey.mobile',
				normalNightTransit: 'normal.night.transit',
				normalNightTransitMobile: 'normal.night.transit.mobile',
				reducedDay: 'reduced.day',
				reducedNight: 'reduced.night',
				basicMap: {
					options: {
						type: 'basetile'
					}
				},
				mapLabels: {
					options: {
						type: 'labeltile',
						format: 'png'
					}
				},
				trafficFlow: {
					options: {
						base: 'traffic',
						type: 'flowtile'
					}
				},
				carnavDayGrey: 'carnav.day.grey',
				hybridDay: {
					options: {
						base: 'aerial',
						variant: 'hybrid.day'
					}
				},
				hybridDayMobile: {
					options: {
						base: 'aerial',
						variant: 'hybrid.day.mobile'
					}
				},
				hybridDayTransit: {
					options: {
						base: 'aerial',
						variant: 'hybrid.day.transit'
					}
				},
				hybridDayGrey: {
					options: {
						base: 'aerial',
						variant: 'hybrid.grey.day'
					}
				},
				pedestrianDay: 'pedestrian.day',
				pedestrianNight: 'pedestrian.night',
				satelliteDay: {
					options: {
						base: 'aerial',
						variant: 'satellite.day'
					}
				},
				terrainDay: {
					options: {
						base: 'aerial',
						variant: 'terrain.day'
					}
				},
				terrainDayMobile: {
					options: {
						base: 'aerial',
						variant: 'terrain.day.mobile'
					}
				}
			}
		}
	};

	L.tileLayer.provider = function (provider, options) {
		return new L.TileLayer.Provider(provider, options);
	};

	return L;
}));
