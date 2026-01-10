document.addEventListener('DOMContentLoaded', function () {
    var registerBtn = document.getElementById('registerbtn');
    var passwordField = document.getElementById('password');
    var confirmField = document.getElementById('confirm_password');
    var errorSpan = document.getElementById('password_error');

    if (registerBtn && passwordField && confirmField && errorSpan) {
        registerBtn.addEventListener('click', function (event) {
            var password = passwordField.value || '';
            var confirmPassword = confirmField.value || '';

            // Allow any password format. Require non-empty and confirmation match.
            if (!password || password.length === 0) {
                errorSpan.textContent = 'Please enter a password.';
                event.preventDefault();
            } else if (password !== confirmPassword) {
                errorSpan.textContent = 'Passwords do not match!';
                event.preventDefault();
            } else {
                errorSpan.textContent = '';
            }
        });
    }

    // Toggle password visibility on pages that have these elements
    var showPasswordCheckbox = document.getElementById('showPassword');
    var loginPasswordField = document.getElementById('login-password');
    if (showPasswordCheckbox && loginPasswordField) {
        showPasswordCheckbox.addEventListener('change', function () {
            loginPasswordField.type = this.checked ? 'text' : 'password';
        });
    }
});