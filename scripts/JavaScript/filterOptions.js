function handleFilterClick(filterType) {
	const section = document.querySelector(`.filter-section[data-filter="${filterType}"]`);
	if (section) {
		const filterOptions = section.querySelectorAll('.filter-option');
		
		filterOptions.forEach(option => {
			option.addEventListener('click', function() {
				filterOptions.forEach(opt => opt.classList.remove('active'));
				this.classList.add('active');
				if (typeof applyFilters !== 'undefined') {
			 	 	applyFilters();
				}
			});
		});
	} else {
		console.log(123);
	};
}

function clearFilters() {
	const filterOptions = document.querySelectorAll('.filter-option');
	filterOptions.forEach(option => {
		option.classList.remove('active');
	});
	
	document.getElementById('year-min').value = 1900;
	document.getElementById('year-max').value = 2025;
	
	if (typeof applyFilters !== 'undefined') {
 	 	applyFilters();
	}
}

document.getElementById('clear-filters').addEventListener('click', clearFilters);

document.addEventListener("DOMContentLoaded", function() {
    handleFilterClick('genre');
    handleFilterClick('type');
    handleFilterClick('year');
});