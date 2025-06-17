<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | ShopEase</title>
    <link rel="stylesheet" href="sign-up-styles.css">
</head>
<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <h1>Welcome to <span>ShopEase</span></h1>
            <p>Join us today and experience the best shopping journey with exclusive deals and offers.</p>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h3>Create Your Account</h3>
            <form id="signup-form">
                <p id="error-message" class="error"></p>

                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>

                <button type="submit">Sign Up</button>
            </form>

            <p>Already have an account? <a href="sign-in.php">Sign In</a></p>
        </div>
    </div>

    <script src="sign-up.js"></script>
</body>
</html>
