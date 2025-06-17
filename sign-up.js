document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("signup-form");
    const errorMessage = document.getElementById("error-message");

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirm_password").value.trim();

        if (password !== confirmPassword) {
            errorMessage.textContent = "Passwords do not match!";
            return;
        }

        if (password.length < 6) {
            errorMessage.textContent = "Password must be at least 6 characters long!";
            return;
        }

        // Send data to PHP via AJAX
        fetch('sign-up-action.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Signup successful")) {
                window.location.href = "sign-in.php";
            } else {
                errorMessage.textContent = data;
            }
        })
        .catch(error => {
            errorMessage.textContent = "An error occurred. Please try again.";
        });
    });
});
