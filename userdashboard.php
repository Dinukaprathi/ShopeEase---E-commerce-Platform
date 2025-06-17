<?php
session_start();
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: sign-in.php');
    exit;
}

// Get user details from DB
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT userID, full_name, email FROM users WHERE userID = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="homepage-styles.css">
    <style>
        .dashboard-container {
            max-width: 500px;
            margin: 3rem auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(18,25,95,0.08);
            padding: 2rem 1.5rem;
            text-align: center;
        }
        .dashboard-container h2 {
            color: #12195F;
            margin-bottom: 1.5rem;
        }
        .dashboard-details {
            text-align: left;
            margin: 0 auto;
            max-width: 350px;
        }
        .dashboard-details p {
            font-size: 1.1rem;
            margin: 0.7em 0;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
        <div class="dashboard-details">
            <p><strong>User ID:</strong> <?php echo $user['userID']; ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

        </div>
    </div>
</body>
</html> 