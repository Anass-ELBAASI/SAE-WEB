// Gestion de l'affichage des formulaires
const authForm = document.getElementById('auth-form');
const registerForm = document.getElementById('register-form');
const authBtn = document.getElementById('auth-btn');
const registerBtn = document.getElementById('register-btn');

authBtn.addEventListener('click', () => {
    authForm.classList.add('active');
    registerForm.classList.remove('active');
    authBtn.classList.add('btn-primary');
    authBtn.classList.remove('btn-secondary');
    registerBtn.classList.add('btn-secondary');
    registerBtn.classList.remove('btn-primary');
});

registerBtn.addEventListener('click', () => {
    registerForm.classList.add('active');
    authForm.classList.remove('active');
    registerBtn.classList.add('btn-primary');
    registerBtn.classList.remove('btn-secondary');
    authBtn.classList.add('btn-secondary');
    authBtn.classList.remove('btn-primary');
});