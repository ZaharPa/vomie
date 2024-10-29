document.getElementById('changeName').onclick = function() {
	document.getElementById('nameModal').style.display = 'flex';
};

document.querySelector('.close').onclick = function() {
	document.getElementById('nameModal').style.display = 'none';
};

document.getElementById('submitName').onclick = function() {
	const newName = document.getElementById('newName').value;
	const id_user = document.getElementById('id_user').value;
	
	if (newName.trim() === '') {
		alert("Please enter a valid name");
		return;
	}
	
	fetch('scripts/changeUser.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			id_user: id_user, 
			newName: newName 
		})
	})
	.then(response => response.json())
	.then(data => {
		if (data.status === "success") {
			alert("Name update successfully");
			document.getElementById('nameModal').style.display = 'none';
			location.reload();
		} else {
			alert("Error: " + data.message);
		}
	})
	.catch(error => {
		console.log("Error: ", error);
	});
}