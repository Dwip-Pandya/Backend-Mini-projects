// Form Validation
const form = document.getElementById('registration-form');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const togglePasswordButtons = document.querySelectorAll('.toggle-password');
const strengthBar = document.querySelector('.strength-fill');
const strengthText = document.querySelector('.strength-text');

function validatePassword(password) {
  const criteria = {
    length: password.length >= 8,
    uppercase: /[A-Z]/.test(password),
    lowercase: /[a-z]/.test(password),
    number: /[0-9]/.test(password),
    special: /[!@#$%^&*]/.test(password)
  };

  const strength = Object.values(criteria).filter(Boolean).length;
  const percentage = (strength / 5) * 100;

  strengthBar.style.width = `${percentage}%`;

  if (percentage <= 20) {
    strengthBar.style.backgroundColor = '#dc3545';
    strengthText.textContent = 'Very Weak';
  } else if (percentage <= 40) {
    strengthBar.style.backgroundColor = '#ffc107';
    strengthText.textContent = 'Weak';
  } else if (percentage <= 60) {
    strengthBar.style.backgroundColor = '#fd7e14';
    strengthText.textContent = 'Medium';
  } else if (percentage <= 80) {
    strengthBar.style.backgroundColor = '#20c997';
    strengthText.textContent = 'Strong';
  } else {
    strengthBar.style.backgroundColor = '#28a745';
    strengthText.textContent = 'Very Strong';
  }

  return Object.values(criteria).every(Boolean);
}

// Password visibility toggle
togglePasswordButtons.forEach(button => {
  button.addEventListener('click', () => {
    const input = button.previousElementSibling;
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);

    const svg = button.querySelector('svg');
    if (type === 'text') {
      svg.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
    } else {
      svg.innerHTML = '<path d="M12 5c-7.333 0-12 6-12 6s4.667 6 12 6 12-6 12-6-4.667-6-12-6Z"/><path d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/>';
    }
  });
});

// Real-time password strength check
passwordInput.addEventListener('input', (e) => {
  validatePassword(e.target.value);
});