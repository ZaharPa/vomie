const commentText = document.getElementById('commentText');
commentText.addEventListener('input', function() {
	commentText.style.height = 'auto';
	commentText.style.height = commentText.scrollHeight + 'px';
})