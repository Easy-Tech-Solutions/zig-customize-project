document.getElementById("registerbtn").addEventListener("click", function(event) {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var errorSpan = document.getElementById("password_error");

    // Password requirements: At least 8 characters, 1 uppercase, 1 lowercase, 1 number, and 1 special character
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!password.match(passwordRegex)) {
        errorSpan.textContent = "Password must be at least 8 characters long and include an uppercase letter, lowercase letter, number, and special character.";
        event.preventDefault(); // Prevent form submission
    } else if (password !== confirmPassword) {
        errorSpan.textContent = "Passwords do not match!";
        event.preventDefault();
    } else {
        errorSpan.textContent = ""; // Clear error if valid
    }
});

 // JavaScript to toggle password visibility
 const showPasswordCheckbox = document.getElementById('showPassword');
 const passwordField = document.getElementById('login-password');

 showPasswordCheckbox.addEventListener('change', function() {
     if (this.checked) {
         passwordField.type = 'text';  // Show password
     } else {
         passwordField.type = 'password';  // Hide password
     }
 });