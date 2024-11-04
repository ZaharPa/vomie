function applyFiltersUser() {
	const id_user = document.getElementById('id_user').value;
	const yearMin = $("#year-min").val();
 	const yearMax = $("#year-max").val();
	    
	const selectedStatus = document.querySelector('.filter-option[data-status].active')?.getAttribute('data-status');
	const selectedtype = document.querySelector('.filter-option[data-type].active')?.getAttribute('data-type');

	fetch('scripts/changeUser.php', {
	    method: 'POST',
	    headers: {
	        'Content-Type': 'application/json',
	    },
	    body: JSON.stringify({
			id_user: id_user,
	        status: selectedStatus,
	        type: selectedtype,
	        year_min: yearMin,
	        year_max: yearMax, 
			option: 'filter'
	    })
 	})
	.then(response => response.json())
	.then(data => {
		console.log(data);
		if (data.error) {
			console.error(data.error);
		} else {
	   		displayUserMovies(data.movies);
		}
	}) 
	.catch(error => console.error("Error fetching movies: ", error));
}

function displayUserMovies(movies) {
	const movieList = document.getElementById('users-movie');
	movieList.innerHTML = '';
		
	movies.forEach(movie => {
		const movieDiv = document.createElement('div');
		movieDiv.classList.add('movie');
	
		const img = document.createElement('img');
		img.src = movie.path + movie.photo;
		img.classList.add('moviePhoto');
		movieDiv.appendChild(img);
			      
		const nameSpan = document.createElement('span');
		nameSpan.textContent = movie.name;
		movieDiv.appendChild(nameSpan);
			
		const typeSpan = document.createElement('span');
		typeSpan.textContent = movie.type;
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

let rateDirection = 'DESC'
document.getElementById('sortRate').onclick = function() {
	const id_user = document.getElementById('id_user').value;
	
	fetch('scripts/changeUser.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_user: id_user, 
			sort: 'rate', 
			direction: rateDirection,
			option: 'sort'
		})
	})
	.then(response => response.json())
	.then(data => {
		displayUserMovies(data.movies);
		
		rateDirection = (rateDirection === 'ASC') ? 'DESC' : 'ASC';
	})
	.catch(error => {
		console.log("Error: ", error);
	});
}

let nameDirection = 'ASC'
document.getElementById('sortName').onclick = function() {
	const id_user = document.getElementById('id_user').value;
	
	fetch('scripts/changeUser.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_user: id_user, 
			sort: 'name', 
			direction: nameDirection,
			option: 'sort'
		})
	})
	.then(response => response.json())
	.then(data => {
		displayUserMovies(data.movies);
		
		nameDirection = (nameDirection === 'ASC') ? 'DESC' : 'ASC';
	})
	.catch(error => {
		console.log("Error: ", error);
	});
}