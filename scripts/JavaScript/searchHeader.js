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
	const resultDiv = document.getElementById('search-results');
	resultDiv.innerHTML = '';
	
	if(data.length > 0) {
		data.forEach(movie => {
			let movieItem = document.createElement('div');
			movieItem.className = 'movie-item';
			movieItem.innerHTML = `<strong>${movie.name}</strong> (${movie.date})`;
			resultDiv.appendChild(movieItem);
		});
	} else {
		resultDiv.innerHTML = 'No result found';
	}
}