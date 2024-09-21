function handleFilterClick(sectionClass) {
	const section = document.querySelector(sectionClass);
	const filterOptions = section.querySelectorAll('.filter-option');
	
	filterOptions.forEach(option => {
		option.addEventListener('click', function() {
			filterOptions.forEach(opt => opt.classList.remove('active'));
			this.classList.add('active');
			applyFilters();
		});
	});
}

function clearFilters() {
	const filterOptions = document.querySelectorAll('.filter-option');
	filterOptions.forEach(option => {
		option.classList.remove('active');
	});
	
	document.getElementById('year-min').value = 1900;
	document.getElementById('year-max').value = 2025;
	
	applyFilters();
}

document.getElementById('clear-filters').addEventListener('click', clearFilters);

handleFilterClick('.filter-section:nth-child(1)');
handleFilterClick('.filter-section:nth-child(2)');