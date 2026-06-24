document.addEventListener('DOMContentLoaded', () => {
    const toggleLogin = document.getElementById('toggle-login');
    const toggleSignup = document.getElementById('toggle-signup');
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const alertBox = document.getElementById('alert-box');

    if (toggleLogin && toggleSignup) {
        toggleLogin.addEventListener('click', () => {
            toggleLogin.classList.add('active');
            toggleSignup.classList.remove('active');
            loginForm.classList.remove('hidden');
            signupForm.classList.add('hidden');
            hideAlert();
        });

        toggleSignup.addEventListener('click', () => {
            toggleSignup.classList.add('active');
            toggleLogin.classList.remove('active');
            signupForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            hideAlert();
        });
    }

    if (loginForm) loginForm.addEventListener('submit', (e) => handleAuth(e, 'login', loginForm));
    if (signupForm) signupForm.addEventListener('submit', (e) => handleAuth(e, 'signup', signupForm));

    function handleAuth(e, action, formElement) {
        e.preventDefault();
        hideAlert();

        const email = formElement.querySelector('input[type="email"]').value;
        const password = formElement.querySelector('input[type="password"]').value;

        const formData = new FormData();
        formData.append('action', action);
        formData.append('email', email);
        formData.append('password', password);

        fetch('auth.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                if (action === 'login') {
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    setTimeout(() => toggleLogin.click(), 1500);
                    formElement.reset();
                }
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(() => {
            showAlert('An error occurred. Check your XAMPP connection.', 'danger');
        });
    }

    function showAlert(text, type) {
        alertBox.textContent = text;
        alertBox.className = `alert ${type}`;
    }

    function hideAlert() {
        if(alertBox) alertBox.className = 'alert hidden';
    }
});