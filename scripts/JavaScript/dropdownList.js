const selectedOption = document.getElementById('selected-option');
const dropdownList = document.getElementById('dropdown-list');
const dropdownItems = document.querySelectorAll('.dropdown-item');
const statusForm = document.getElementById('statusForm');
const statusInput = document.getElementById('status');

selectedOption.addEventListener('click', () => {
	dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
});

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
	const formData = new FormData(statusForm);
	
	fetch('users-status.php', {
		method: 'POST',
		body: formData
	})
	.then(response =>response.text())
	.then(data => {
		console.log(data);
	})
	.catch(error => {
		console.error('Error: ', error);
	});
}