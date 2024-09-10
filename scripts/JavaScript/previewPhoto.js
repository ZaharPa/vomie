document.addEventListener('DOMContentLoaded', function(){
	const containers = document.querySelectorAll('.upload-container');
	containers.forEach((container, index) => {
		const fileInput = container.querySelector('input[type="file"]');
		const preview = container.querySelector('img');
		
		fileInput.addEventListener('change' , function (event) {
			const file = event.target.files[0];
			if (file && file.type.startsWith('image/')) {
				const reader = new FileReader();
				
				reader.onload = function (e) {
					preview.src = e.target.result;
					if (index < containers.length - 1) {
						containers[index + 1].classList.remove('hidden');
					}
				};
				reader.readAsDataURL(file);
			} else {
				alert("Please select a valid image file. ");
			}
		});
	});
});

