function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', passwordType);
}

// Add event listener to the form
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Validate email and password
        if (email === '') {
            alert('Please enter your email.');
            return; // Stop further execution
        }
        if (password === '') {
            alert('Please enter your password.');
            return; // Stop further execution
        }
    });
});
