'use strict'
let api;
$(document).ready(function(){
	api = $('#gallery').unitegallery({
		gallery_skin:"alexis",				
		slider_bullets_skin: "alexis"
	});
	api.play();
	let width = 1600;
	api.resize(width);
});