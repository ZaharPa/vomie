const commentForm = document.getElementById('commentText');
commentForm.addEventListener('input', function() {
	commentForm.style.height = 'auto';
	commentForm.style.height = commentForm.scrollHeight + 'px';
});

document.getElementById('submitCom').addEventListener('click', function() {
	const id_movie = document.getElementById('id_movie').value;
	const id_user = document.getElementById('id_user').value;
	const dateCom = document.getElementById('dateCom').value;
	const commentText = commentForm.value; 
	
	if(commentText === "") {
		alert("Please enter a comment");
		return;
	}
	
	fetch('scripts/editComment.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_movie: id_movie,
			id_user: id_user,
			dateCom: dateCom,
			commentText: commentText, 
			option: 'add'
		})
	})
	.then(response=>response.text())
	.then(data=> {
		console.log(data);
	})
	.catch(error => {
		console.error('Error: ', error);
	});
});