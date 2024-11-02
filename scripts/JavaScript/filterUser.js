function applyFiltersUser() {
	const yearMin = $("#year-min").val();
 	const yearMax = $("#year-max").val();
	    
	const selectedStatus = document.querySelector('.filter-option[data-status].active')?.getAttribute('data-status');
	const selectedtype = document.querySelector('.filter-option[data-type].active')?.getAttribute('data-type');

	fetch('scripts/filterUser.php', {
	    method: 'POST',
	    headers: {
	        'Content-Type': 'application/json',
	    },
	    body: JSON.stringify({
	        status: selectedStatus,
	        type: selectedtype,
	        year_min: yearMin,
	        year_max: yearMax, 
			option: 'filter'
	    })
 	})
	.then(response => response.json())
	.then(data => {
	   displayUserMovies(data.movies);
	});
}

function displayUserMovies(movies) {
	const movieList = document.getElementById('movie-list');
	movieList.innerHTML = '';
		
	movies.forEach(movie => {
		const movieDiv = document.createElement('div');
		movieDiv.classList.add('movie');
	
		const img = document.createElement('img');
		img.src = movie.photoPath;
		img.classList.add('moviePhoto');
		movieDiv.appendChild(img);
			      
		const nameSpan = document.createElement('span');
		nameSpan.textContent = movie.name;
		movieDiv.appendChild(nameSpan);
			
		const typeSpan = document.createElement('span');
		typeSpan.textContent = movie.status;
		movieDiv.appendChild(typeSpan);
		
		const statusSpan = document.createElement('span');
		statusSpan.textContent = movie.status;
		movieDiv.appendChild(statusSpan);

		const rateSpan = document.createElement('span');
		rateSpan.textContent = movie.rate;
		movieDiv.appendChild(rateSpan);				

		movieList.appendChild(movieDiv);
	});
}