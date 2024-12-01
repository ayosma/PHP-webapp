<?php
require_once '../includes/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Web App</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome to My Web Application</h1>
        
        <?php if (is_logged_in()): ?>
            <p>Hello, <?php echo $_SESSION['username']; ?>! 
               <a href="dashboard.php">Go to Dashboard</a> | 
               <a href="profile.php">View Profile</a> |
               <a href="logout.php">Logout</a> |
               <a href="contact.php">Contact Us</a>
            </p>
        <?php else: ?>
            <p>Please <a href="login.php">Login</a> or <a href="register.php">Register</a> | <a href="contact.php">Contact Us</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
