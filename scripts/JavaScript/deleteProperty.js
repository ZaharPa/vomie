function deletePhoto(index) {
	document.getElementById('delete-photo-' + index).value = '1';  
    document.getElementById('preview-' + index).style.display = 'none'; 
}

function deleteLink(index) {
    document.getElementById('delete-link-' + index).value = '1';  
}

function deleteCast(index) {
    document.getElementById('delete-cast-' + index).value = '1';
}