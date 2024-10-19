const stars = document.querySelectorAll('.star');
let selectedValue = 0;

stars.forEach((star, index) => {
	star.addEventListener('click', (e) => {
		const rect = e.currentTarget.getBoundingClientRect();
		const mouseX = e.clientX - rect.left;
		const halfValue = (mouseX < rect.width / 2) ? 0.5 : 1;
		selectedValue = index + halfValue;
		console.log(selectedValue);

		updateStars(selectedValue);
	});
	
	star.addEventListener('mouseover', (e) => {
		const rect = e.currentTarget.getBoundingClientRect();
 		const mouseX = e.clientX - rect.left;
		const halfValue = (mouseX < rect.width / 2) ? 0.5 : 1;
		
		updateStars(index + halfValue);
	});
	
});

function updateStars(hoverValue) {
	stars.forEach((s, i) => {
		s.classList.remove('full', 'half');
		if (hoverValue !== undefined) {
			if (i < Math.floor(hoverValue)) {
				s.classList.add('full');
			} else if (i === Math.floor(hoverValue) && hoverValue % 1 !== 0) {
				s.classList.add('half');
			}
		} 
	});
}