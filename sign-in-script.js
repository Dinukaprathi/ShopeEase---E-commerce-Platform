document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("sign-in-form");
    if (form) {
        form.addEventListener("submit", function(event) {
            event.preventDefault();  // Prevent default form submission

            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Mock user data for testing
            var validEmail = "avishka@123.com";
            var validPassword = "123";

            if (email === validEmail && password === validPassword) {
                alert("Sign-in successful!");
                window.location.href = "userdashboard.php"; // Redirect to profile page
            } else {
                document.getElementById("error-message").classList.remove("hidden");
            }
        });
    }
});
