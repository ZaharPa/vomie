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
		
		commentForm.value = '';
		
		loadComments(id_movie);
	})
	.catch(error => {
		console.error('Error: ', error);
	});
	
});

document.addEventListener('DOMContentLoaded', function() {
	const id_movie = document.getElementById('id_movie').value;
	loadComments(id_movie);
})

function loadComments(id_movie) {
	fetch('scripts/editComment.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_movie: id_movie,
			option: 'view'
		})
	})
	.then(response => response.json())
	.then(data => {
		const commentsList = document.querySelector('.comments-list');
		commentsList.innerHTML = '';
		
		if (data.length === 0) {
			commentsList.innerHTML = '<p>No comments yet. Be first to comment</p>';
			return;
		} 
		
		let commentsShown = 0; 
		const commentsPerPage = 10; 
		
		const loadMoreButton = document.createElement('button');
		loadMoreButton.className = 'show-more-button';
		loadMoreButton.innerText = 'Show more';
		
		function displayComments() {
			const nextComments = data.slice (commentsShown, commentsShown + commentsPerPage);
			
			nextComments.forEach(comment => {
				const commentDiv = document.createElement('div');
				
				commentDiv.className = 'comment';
				commentDiv.innerHTML = `
					<h4>${comment.name_user}</h4>
					<small class="dateCom">${comment.date}</small>
					<p>${comment.comment}</p>
					${role === 'admin' ? `<button type="button" class="delete-com" data-id="${comment.id_comment}">&times;</button>` : ''}
				`;
				
				const deleteButton = commentDiv.querySelector('.delete-com');
				if(deleteButton) {
					deleteButton.addEventListener('click', function() {
						const id_comment = this.getAttribute('data-id');
						deleteComment(id_comment, id_movie);
					})
				}
								
				commentsList.appendChild(commentDiv);
			});
			
			commentsShown += commentsPerPage;
			
			if (commentsShown < data.length) {
				if (!document.querySelector('.show-more-button')) {
					commentsList.appendChild(loadMoreButton);
				}
				loadMoreButton.style.display = 'block';
			} else {
				loadMoreButton.style.display = 'none';
			}
		}
		
		loadMoreButton.addEventListener('click', displayComments);		

		displayComments();
	})
	.catch(error => {
		console.error('Error loading comments: ', error);
	});
}

function deleteComment (id_comment, id_movie) {
	fetch('scripts/editComment.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_comment: id_comment,
			option: 'delete'
		})
	})
	.then(response=>response.text())
	.then(data=> {
		console.log(data);			
		loadComments(id_movie);
	})
	.catch(error => {
		console.error('Error: ', error);
	});
}