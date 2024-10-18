const stars = document.querySelectorAll('.star');
let selectedValue = 0;

stars.forEach((star, index) => {
	star.addEventListener('click', () => {
		const value = index + 1;
		selectedValue = value;
		console.log(value);
		
		updateStars();
	});
	
	star.addEventListener('mouseover', () => {
		updateStars(index + 0.5);
	});
	
	star.addEventListener('mouseout', () => {
		updateStars();
	});
});

function updateStars(hoverValue) {
	stars.forEach((s, i) => {
		s.classList.remove('full', 'active');
		if (hoverValue !== undefined) {
			if (i < Math.floor(hoverValue)) {
				s.classList.add('full');
			}
			
			if (i === Math.floor(hoverValue) && hoverValue % 1 !== 0) {
				s.classList.add('active');
			}
		} else {
			if (i < selectedValue) {
				s.classList.add('full')
			}
		}
	});
}