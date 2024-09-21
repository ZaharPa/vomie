function applyFilters() {
    const yearMin = $("#year-min").val();
    const yearMax = $("#year-max").val();
    
    const selectedGenre = document.querySelector('.filter-option[data-genre].active')?.getAttribute('data-genre');
    const selectedtype = document.querySelector('.filter-option[data-type].active')?.getAttribute('data-type');

    fetch('scripts/filter.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            genre: selectedGenre,
            type: selectedtype,
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
	const movieList = document.getElementById('movie-list');
	movieList.innerHTML = '';
	
	movies.forEach(movie => {
		const movieCard = document.createElement('div');
		movieCard.classList.add('movie-card');
		
		let imgSrc = '';
		
		for (let i = 0; i < moviePhoto.length; i++) {
		       if (moviePhoto[i].id_movie == movie.id_movie) {
		           imgSrc = moviePhoto[i].path + moviePhoto[i].photo;
		           break;
		       }
		   }
		   
		const img = document.createElement('img');
		img.src = imgSrc;
		img.alt = movie.name;
		      
		const p = document.createElement('p');
		p.textContent = movie.name;
		
		movieCard.appendChild(img);
		movieCard.appendChild(p);
		
		movieList.appendChild(movieCard);
	})
}