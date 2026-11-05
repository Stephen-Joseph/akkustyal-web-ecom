// 1. Show / Hide Password
const passwordInput = document.getElementById('password');
const passwordToggle = document.getElementById('passwordToggle');

passwordToggle.addEventListener('click', () => {
  const isHidden = passwordInput.type === 'password';
  passwordInput.type = isHidden ? 'text' : 'password';
  passwordToggle.setAttribute('aria-pressed', String(isHidden));
  passwordToggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
  passwordToggle.querySelector('.icon-eye').hidden = isHidden;
  passwordToggle.querySelector('.icon-eye-off').hidden = !isHidden;
});

// 2. Submit: client-side required check + loading state
const loginForm = document.getElementById('loginForm');
const submitBtn = document.getElementById('submitBtn');

loginForm.addEventListener('submit', (event) => {
  if (!loginForm.checkValidity()) {
    event.preventDefault();
    loginForm.querySelectorAll('.form-input').forEach((input) => {
      input.classList.toggle('is-invalid', !input.checkValidity());
    });
    loginForm.querySelector('.form-input:invalid')?.focus();
    return;
  }

  submitBtn.disabled = true;
  submitBtn.classList.add('is-loading');
  submitBtn.querySelector('.btn-label').textContent = 'Signing in...';
});

loginForm.querySelectorAll('.form-input').forEach((input) => {
  input.addEventListener('input', () => input.classList.remove('is-invalid'));
});
