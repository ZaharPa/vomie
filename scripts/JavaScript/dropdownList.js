const selectedOption = document.getElementById('selected-option');
const dropdownList = document.getElementById('dropdown-list');
const dropdownItems = document.querySelectorAll('.dropdown-item');
const statusForm = document.getElementById('statusForm');
const statusInput = document.getElementById('status');
const currentStatus = statusInput.value;

selectedOption.addEventListener('click', () => {
	dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
});

if (currentStatus) {
	dropdownItems.forEach(item => {
		if (item.dataset.value === currentStatus) {
			selectedOption.textContent = item.textContent;
			selectedOption.dataset.value = item.dataset.value;
			item.classList.add('active');
		}
	});
}

dropdownItems.forEach(item =>{
	item.addEventListener('click', () => {
		selectedOption.textContent = item.textContent;
		selectedOption.dataset.value = item.dataset.value;
		
		statusInput.value = item.dataset.value;
		
		submitStatus();
		
		dropdownItems.forEach(i => i.classList.remove('active'));
		item.classList.add('active');
		
		dropdownList.style.display = 'none';	
	});
});

document.addEventListener('click', function(e) {
	if (!document.querySelector('.custom-dropdown').contains(e.target)) {
		dropdownList.style.display = 'none';
	}
});

function submitStatus() {
	const idUser = parseInt(document.getElementById('id_user').value);
	const idMovie = parseInt(document.getElementById('id_movie').value); 
	const selectedStatus = document.getElementById('status').value;
		
	fetch('scripts/usersStatus.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_user: idUser,
			id_movie: idMovie,
			status: selectedStatus
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