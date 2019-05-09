'use strict'

window.onload = function () {

	let frame = document.getElementById('frame');
	let img = document.createElement('img');
	img.className = 'workWithCustomer-projects__frameImage';

	for (let i = 1; i < 11; i++) {
		frame.insertAdjacentHTML(`beforeEnd`, `<img src="../packages/images/projects/${01_mural_art}/general/${i}.jpg" alt="#" class="workWithCustomer-projects__frameImage">`);
	}
}

