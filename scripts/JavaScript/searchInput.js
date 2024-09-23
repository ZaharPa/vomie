document.getElementById('search-input').addEventListener('input', function() {
	let query = this.value;
	
	if(query.length > 0) {
		fetch('scripts/search.php?limit=false&query=' + encodeURIComponent(query))
		.then(response => response.json())
		.then(data => {
			console.log(data);
			displayMovies(data);
		})
		.catch(error => {
			console.error('Error fetching data: ', error);
		});
	} 
});