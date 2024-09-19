function applyFliters() {
	const yearMin = $("#year-min").val();
	const yearMax = $("#year-max").val();
	
	const selectedGenre = document.querySelector('.filter-option[data-genre].active')?.getAttribute('data-genre');
	const selectedStatus = document.querySelector('.filter-option[data-status].active')?.getAttribute('data-status');

	fetch('scripts/filter.php', {
		method: 'POST',
		header: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			genre: selectedGenre, 
			status: selectedStatus, 
			year_min: yearMin, 
			year_max: yearMax
		})
	})
	.then(response => response.json())
	.then(data => {
		displayMovies(data.movies);
	});
}

function displayMovies(movies) {

}