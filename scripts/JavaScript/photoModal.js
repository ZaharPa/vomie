function openModal(imgSrc) {
	const modal = document.getElementById("photoModal");
	const modalImg = document.getElementById("modalImage");
	
	modal.style.display = "flex";
	modalImg.src = imgSrc;
	
	window.onclick = function(event) {
		if (event.target == modal) {
			closeModal();
		}
	};
}

function closeModal() {
	const modal = document.getElementById("photoModal");
	modal.style.display = "none";
}