const form = document.getElementById('login-form');
const passwordInput = document.getElementById('password');
const togglePasswordButton = document.querySelector('.toggle-password');

// Form validation
form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    let isValid = true;

    // Validate email
    const email = formData.get('email');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('emailError').textContent = 'Please enter a valid email';
        isValid = false;
    } else {
        document.getElementById('emailError').textContent = '';
    }

    // Validate password
    const password = formData.get('password');
    if (password.length < 8) {
        document.getElementById('passwordError').textContent = 'Password must be at least 8 characters';
        isValid = false;
    } else {
        document.getElementById('passwordError').textContent = '';
    }

    
});

// Password visibility toggle
togglePasswordButton.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    const svg = togglePasswordButton.querySelector('svg');
    if (type === 'text') {
        svg.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
    } else {
        svg.innerHTML = '<path d="M12 5c-7.333 0-12 6-12 6s4.667 6 12 6 12-6 12-6-4.667-6-12-6Z"/><path d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>';
    }
});

// Add hover effect to avatar
const avatarImage = document.querySelector('.avatar-image');
let isAnimating = false;

avatarImage.addEventListener('mousemove', (e) => {
    if (!isAnimating) {
        const rect = avatarImage.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const angleX = (y - centerY) / 20;
        const angleY = (centerX - x) / 20;

        avatarImage.style.transform = `rotateX(${angleX}deg) rotateY(${angleY}deg)`;
    }
});

avatarImage.addEventListener('mouseleave', () => {
    isAnimating = true;
    avatarImage.style.transform = 'rotateX(0) rotateY(0)';
    setTimeout(() => {
        isAnimating = false;
    }, 300);
});

// Add ripple effect to login button
const loginButton = document.querySelector('.login-button');

loginButton.addEventListener('click', function (e) {
    const rect = this.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const ripple = document.createElement('span');
    ripple.style.left = `${x}px`;
    ripple.style.top = `${y}px`;
    ripple.classList.add('ripple');

    this.appendChild(ripple);

    setTimeout(() => {
        ripple.remove();
    }, 600);
});

// Add input focus animations
const inputs = document.querySelectorAll('input');

inputs.forEach(input => {
    input.addEventListener('focus', () => {
        const icon = input.parentElement.querySelector('.input-icon');
        if (icon) {
            icon.style.color = 'var(--primary-color)';
            icon.style.opacity = '1';
        }
    });

    input.addEventListener('blur', () => {
        const icon = input.parentElement.querySelector('.input-icon');
        if (icon) {
            icon.style.color = 'var(--text-color)';
            icon.style.opacity = '0.5';
        }
    });
});