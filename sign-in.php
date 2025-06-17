<?php
session_start();
require 'config.php';

$error = '';
$login_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Fetch user by email
    $stmt = $conn->prepare("SELECT userID, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $user['password'] === $password) { // Plain text password check
        $_SESSION['user_id'] = $user['userID'];
        $login_success = true;
        // Delay redirect to show alert
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="refresh" content="2;url=userdashboard.php"><title>Login Success</title><style>.alert-success{background:#28a745;color:#fff;padding:1.5em 2em;border-radius:10px;box-shadow:0 4px 16px rgba(18,25,95,0.08);font-size:1.3em;text-align:center;max-width:350px;margin:10vh auto;}</style></head><body><div class="alert-success">Login successful!<br>Redirecting to your dashboard...</div></body></html>';
        exit;
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | ShopEase</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sign-in-styles.css">
    <style>
        .alert-fail {
            background: #dc3545;
            color: #fff;
            padding: 1em 1.5em;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(220,53,69,0.08);
            font-size: 1.1em;
            text-align: center;
            margin-bottom: 1em;
            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
        }
        .hidden { display: none; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Section: Narration -->
        <div class="left-section">
            <h1>Welcome to <span>ShopEase</span></h1>
            <p>Your one-stop solution for a seamless and smarter shopping experience.  
               Explore, purchase, and enjoy hassle-free transactions with just a few clicks.</p>
        </div>

        <!-- Right Section: Sign-in Form -->
        <div class="right-section">
            <h3>Sign In to ShopEase</h3>
            <?php if ($error): ?>
                <div class="alert-fail"> <?php echo $error; ?> </div>
            <?php endif; ?>
            <div id="error-message" class="hidden" style="color: red; margin-bottom: 1em; text-align: center;">
                Invalid email or password.
            </div>
            <form id="sign-in-form" method="POST" action="sign-in.php">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                <button type="submit">Sign In</button>
            </form>
            <p>Don't have an account? <a href="sign-up.php">Sign Up</a></p>
        </div>
    </div>

    <script>
    const errorMsg = document.getElementById("error-message");
    if (errorMsg) {
        errorMsg.classList.remove("hidden");
    }
    </script>
</body>
</html>
