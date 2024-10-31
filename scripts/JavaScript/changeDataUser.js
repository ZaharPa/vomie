document.getElementById('changeName').onclick = function() {
	document.getElementById('nameModal').style.display = 'flex';
};

document.querySelectorAll('.close').forEach(function(closeButton) {
	closeButton.onclick = function() {
		document.getElementById('nameModal').style.display = 'none';
		document.getElementById('passModal').style.display = 'none';
		document.getElementById('photoModal').style.display = 'none';
	};
});

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
			newName: newName, 
			option: 'name'
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

document.getElementById('changePass').onclick = function() {
	document.getElementById('passModal').style.display = 'flex';
};

document.getElementById('submitPass').onclick = function() {
	const oldPass = document.getElementById('oldPass').value;
	const newPass = document.getElementById('newPass').value;
	const id_user = document.getElementById('id_user').value;
	
	if (newPass.trim() === '') {
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
			newPass: newPass, 
			oldPass: oldPass, 
			option: 'pass'
		})
	})
	.then(response => response.json())
	.then(data => {
		if (data.status === "success") {
			alert("Password update successfully");
			document.getElementById('passModal').style.display = 'none';
		} else {
			alert("Error: " + data.message);
		}
	})
	.catch(error => {
		console.log("Error: ", error);
	});
}

document.getElementById('changePhoto').onclick = function() {
	document.getElementById('photoModal').style.display = 'flex';
};

document.getElementById('submitPhoto').onclick = function() {
	const id_user = document.getElementById('id_user').value;
	const fileInput = document.getElementById('file-input-user');
	const file = fileInput.files[0];
	
	if (file) {
		const reader = new FileReader;
		
		reader.onload = function(event) {
			const base64Image = event.target.result.split(",")[1];
			
			const data = {
				filename: file.name,
				filedata: base64Image, 
				id_user: id_user, 
				option: 'photo'
			};
		
			fetch('scripts/changeUser.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify(data)
			})
			.then(response => response.json())
			.then(data => {
				if (data.status === "success") {
					alert("Photo update successfully");
					document.getElementById('photoModal').style.display = 'none';
					location.reload();
				} else {
					alert("Error: " + data.message);
				}
			})
			.catch(error => {
				console.log("Error: ", error);
			});
		};
		
		reader.readAsDataURL(file);
	}
};
