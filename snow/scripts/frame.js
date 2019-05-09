'use strict'

let links = document.querySelectorAll('.workWithCustomer__link');
let	frame = document.getElementById('frame');
let	img = document.createElement('img');
let	link, html;

img.className = 'workWithCustomer-projects__frameImage';

function changeFrame(event) {
	event.preventDefault();
	html =``;
	for (let i = 0; i < links.length; i++) {
		link = links[i];
		if (link.classList.contains(`linkActive`)) {
			link.classList.remove(`linkActive`);
		}
	}
	this.classList.add('linkActive');
	frame.innerHTML = '';
	for (let i = 1; i < 11; i++) {
		html += `<img src="../packages/images/projects/${this.dataset.folder}/general/${i}.jpg" alt="#" class="workWithCustomer-projects__frameImage">`; 
	}
	frame.innerHTML = html;
}

for (let i = 0; i < links.length; i++) {
	link = links[i];
	link.addEventListener(`click`, changeFrame);	
}


