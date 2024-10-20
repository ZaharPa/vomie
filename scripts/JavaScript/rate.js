const stars = document.querySelectorAll('.star');
let selectedValue = 0;

if (startStars) {
	updateStars(startStars);
}

stars.forEach((star, index) => {
	star.addEventListener('click', (e) => {
		const rect = e.currentTarget.getBoundingClientRect();
		const mouseX = e.clientX - rect.left;
		const halfValue = (mouseX < rect.width / 2) ? 0.5 : 1;
		selectedValue = index + halfValue;
		
		updateStars(selectedValue);
		submitRate(selectedValue * 2);
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

function submitRate(selectedRate) {
	const idUser = parseInt(document.getElementById('id_user').value);
	const idMovie = parseInt(document.getElementById('id_movie').value); 
	
	fetch('scripts/usersStatus.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_user: idUser,
			id_movie: idMovie,
			rate: selectedRate
		})
	})
	.then(response =>response.text())
	.then(data => {
		console.log(data);
	})
	.catch(error => {
		console.error('Error: ', error);
	});
}