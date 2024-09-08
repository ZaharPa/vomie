function showModal(massage) {
	var modal = document.getElementById("modal");
    var span = document.getElementsByClassName("close")[0];
    var modalText = document.getElementById("modal-text");
        	
    modalText.innerText = massage;
    modal.style.display = "block";
        	
    span.onclick = function() {
        modal.style.display = "none";
    }
        	
    window.onclick = function(event) {
        if (event.target == modal) {
        	modal.style.display = "none";
        }
    }
}
