const selectedOption = document.getElementByid('select-option');
const dropdownList = document.getElementById('dropdown-list');
const dropdownItems = document.querySelectorAll('.dropdown-item');

selectedOption.addEventListener('click', () => {
	dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
});

dropdownItems.forEach(item =>{
	item.addEventListener('click', () => {
		selectedOption.textContent = item.textContent;
		selectedOption.dataset.value = item.dataset.value;
		
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