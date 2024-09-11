document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.showMore');
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const nextFormGroup = button.closest('.form-group').nextElementSibling;
            if (nextFormGroup && nextFormGroup.classList.contains('hidden')) {
                nextFormGroup.classList.remove('hidden');
                button.classList.add('hidden');
            }
        });
    });
});