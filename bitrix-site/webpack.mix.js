const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
	.setPublicPath('local/templates/smerch/')
	.copyDirectory('local/templates/smerch/resources/assets', 'local/templates/smerch/assets')
	.js('local/templates/smerch/resources/scripts/main.js', 'local/templates/smerch/scripts')
	.js('local/templates/smerch/resources/scripts/catalog.element.js', 'local/templates/smerch/scripts')
	.js('local/templates/smerch/resources/scripts/components/splide.js', 'local/templates/smerch/scripts')
	.js('local/templates/smerch/resources/scripts/faq.js', 'local/templates/smerch/scripts')
	.js('local/templates/smerch/resources/scripts/popup.js', 'local/templates/smerch/scripts')
	.js('local/templates/smerch/resources/scripts/homepage.js', 'local/templates/smerch/scripts')
	.sass('local/templates/smerch/resources/styles/app.sass', 'local/templates/smerch/styles/app.css')
	.minify([
		'local/templates/smerch/components/bitrix/catalog.element/.default/script.js',
		'local/templates/smerch/components/bitrix/catalog.element/basket.popup/script.js',
		'local/templates/smerch/components/bitrix/sale.personal.profile.list/.default/script.js',
		'local/templates/smerch/components/bitrix/socserv.auth.split/.default/script.js',
		'local/templates/smerch/components/bitrix/sale.basket.basket.line/.default/script.js',
		'local/templates/smerch/components/bitrix/sale.basket.basket/.default/script.js',
		'local/templates/smerch/components/bitrix/sale.basket.basket/.default/js/component.js',
		'local/templates/smerch/components/bitrix/sale.basket.basket/.default/js/action-pool.js',
		'local/templates/smerch/components/bitrix/sale.basket.basket/.default/js/filter.js',
		'local/templates/smerch/components/bitrix/sale.basket.basket/.default/js/mustache.js',
		'local/templates/smerch/components/bitrix/sale.basket.basket/.default/style.css',
		'local/templates/smerch/components/bitrix/menu/personal/script.js',
		'local/templates/smerch/components/itleague/sale.order.ajax/.default/style.css',
		'local/templates/smerch/components/itleague/catalog.section/poshtuchno/script.js',
		'local/templates/smerch/components/itleague/catalog.section/collabs/script.js',
		'local/templates/smerch/components/bitrix/sale.personal.order.list/.default/script.js',
		'local/templates/smerch/components/bitrix/main.profile/.default/script.js',
		'local/templates/smerch/components/bitrix/sale.location.selector.search/.default/style.css',
		'local/templates/smerch/components/itleague/subscribe.form.component/.default/script.js',
		'local/templates/smerch/components/itleague/sizes.component/.default/script.js',
		'local/templates/smerch/components/ipol/ipol.dpdPickup/order/style.css',
		'local/templates/smerch/components/ipol/ipol.dpdPickup/order/bitrix/map.yandex.view/dpd.pickup/script.js'
	])
	.combine(
		[
			'local/templates/smerch/components/ipol/ipol.dpdPickup/order/map.js',
			'local/templates/smerch/components/ipol/ipol.dpdPickup/order/script.js'
		], 'local/templates/smerch/components/ipol/ipol.dpdPickup/order/script.min.js')
	.combine(
		[
			'local/templates/smerch/components/itleague/sale.order.ajax/.default/order_ajax.js',
			'local/templates/smerch/components/itleague/sale.order.ajax/.default/script.js',
		], 'local/templates/smerch/components/itleague/sale.order.ajax/.default/script.min.js')
	.combine(
		[
			'bitrix/js/sale/core_ui_widget.js',
			'bitrix/js/sale/core_ui_etc.js',
			'bitrix/js/sale/core_ui_autocomplete.js',
			'local/templates/smerch/components/bitrix/sale.location.selector.search/.default/script.js'
		], 'local/templates/smerch/components/bitrix/sale.location.selector.search/.default/script.min.js')
	.options({
		processCssUrls: false
	}).version();
