const mobileBtn = document.getElementById('mobile-btn');
const menu = document.getElementById('menu');

mobileBtn.addEventListener('click', function() {
	menu.classList.toggle('open');
	
	const dropdowns = document.querySelectorAll('.mobile');
	dropdowns.forEach(function(dropdown) {
		dropdown.style.display = 'block';
	});
});