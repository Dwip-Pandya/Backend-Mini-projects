document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#pswd');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // File upload preview
    const fileInput = document.querySelector('#file123');
    const filePreview = document.querySelector('.file-preview');
    const fileLabel = document.querySelector('.file-upload label span');

    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                filePreview.innerHTML = `
                    <img src="${e.target.result}" 
                         style="max-width: 100px; max-height: 100px; border-radius: 50%; margin-top: 10px; 
                         box-shadow: 0 2px 5px rgba(0,0,0,0.2);">`;
                fileLabel.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    });

    // Form validation and submission animation
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('.submit-btn');

    form.addEventListener('submit', function(e) {
        // Add success animation to button
        submitBtn.classList.add('success');
        setTimeout(() => {
            submitBtn.classList.remove('success');
        }, 1000);
    });

    // Input animations
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
});