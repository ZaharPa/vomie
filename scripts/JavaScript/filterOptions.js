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

handleFilterClick('.filter-section:nth-child(1)');
handleFilterClick('.filter-section:nth-child(2)');