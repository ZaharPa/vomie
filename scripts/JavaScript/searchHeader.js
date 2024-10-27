document.getElementById('search-btn').addEventListener('click', function() {
	const query = document.getElementById('search-input-header').value;
	
	if (query.length > 0) {
		fetchResults(query);
	} 
});

document.getElementById('search-input-header').addEventListener('input', function(){
	const query = this.value;
	
	if(query.length > 2) {
		fetchResults(query);
	} else {
		document.getElementById('search-results').innerHTML = '';
	}
});

function fetchResults(query) {
	fetch('scripts/search.php?limit=true&query=' + encodeURIComponent(query))
	.then(response => response.json())
	.then(data => {
		searchResult(data);
	})
	.catch(error => {
		console.error("Error fetching data: ", error);
	});
}

function searchResult(data) {
	const searchInput = document.getElementById('search-input-header');
	const resultDiv = document.getElementById('search-results');
	resultDiv.innerHTML = '';
	resultDiv.style.display = 'block';
	console.log('blick');
	
	if(data.length > 0) {
		data.forEach(movie => {
			let movieItem = document.createElement('div');
			movieItem.className = 'movie-item';
			movieItem.innerHTML = `<strong><a href="index.php?page=movieDetail&id=${movie.id_movie}">${movie.name}</a></strong> (${movie.date})`;
			resultDiv.appendChild(movieItem);
		});
	} else {
		resultDiv.innerHTML = 'No result found';
	}
	
	searchInput.addEventListener('keyup', function() {
		if (searchInput.value.trim() === '') {
			resultDiv.style.display = 'none';
		}
	});
}