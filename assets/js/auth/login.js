// Mobile menu navbar
document.getElementById('menu-button').addEventListener('click', () => {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
});

// Toggle password
const togglePassword = document.getElementById('toggle-password');
const passwordField = document.getElementById('password');

togglePassword.addEventListener('click', () => {
    const type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;
    togglePassword.innerHTML = type === 'password' 
        ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12l-3 3-3-3"></path></svg>` 
        : `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c4.418 0 8 3.582 8 8s-3.582 8-8 8-8-3.582-8-8 3.582-8 8-8zm0 0v16m0 0l4-4m-4 4l-4-4"></path></svg>`;
});

// Menampilkan modal
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('error')) {
    const errorMessage = urlParams.get('error');
    document.getElementById('modal-message').textContent = errorMessage;
    document.getElementById('error-modal').classList.remove('hidden');
}

// Tutup modal
document.getElementById('close-modal').addEventListener('click', () => {
    document.getElementById('error-modal').classList.add('hidden');
});