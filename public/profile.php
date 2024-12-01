<?php
require_once '../includes/session.php';
require_once '../config/database.php';

require_login();

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if ($current_password !== $user['password']) {
        $error = "Current password is incorrect";
    } elseif (!empty($new_password)) {
       
        if ($new_password !== $confirm_new_password) {
            $error = "New passwords do not match";
        } elseif (strlen($new_password) < 6) {
            $error = "New password must be at least 6 characters long";
        } else {
         
            $update_sql = "UPDATE users SET email = '$email', password = '$new_password' WHERE id = $user_id";
            
            if ($conn->query($update_sql) === TRUE) {
                $success = "Profile updated successfully";
             
                $result = $conn->query($sql);
                $user = $result->fetch_assoc();
            } else {
                $error = "Error updating profile: " . $conn->error;
            }
        }
    } else {
      
        $update_sql = "UPDATE users SET email = '$email' WHERE id = $user_id";
        
        if ($conn->query($update_sql) === TRUE) {
            $success = "Profile updated successfully";
          
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();
        } else {
            $error = "Error updating profile: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>User Profile</h1>
        
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        
        <form method="post" onsubmit="return validateProfileForm()">
            <h2>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
            
            <label>Username</label>
            <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
            
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <h3>Change Password (optional)</h3>
            <input type="password" name="current_password" placeholder="Current Password">
            <input type="password" name="new_password" placeholder="New Password">
            <input type="password" name="confirm_new_password" placeholder="Confirm New Password">
            
            <button type="submit">Update Profile</button>
        </form>
        
        <div class="actions">
            <a href="create_item.php" class="btn">Create New Item</a>
            <a href="profile.php" class="btn">View Profile</a>
            <a href="index.php" class="btn">Home</a> <!-- Added Home button -->
            <a href="logout.php" class="btn logout">Logout</a>
        </div>
    </div>

    <script>
    function validateProfileForm() {
        const email = document.querySelector('input[name="email"]').value;
        const currentPassword = document.querySelector('input[name="current_password"]').value;
        const newPassword = document.querySelector('input[name="new_password"]').value;
        const confirmNewPassword = document.querySelector('input[name="confirm_new_password"]').value;

        
        if (!email.includes('@')) {
            alert('Please enter a valid email address');
            return false;
        }

    
        if (newPassword || confirmNewPassword) {
            if (currentPassword.length === 0) {
                alert('Please enter your current password');
                return false;
            }

            if (newPassword.length > 0 && newPassword.length < 6) {
                alert('New password must be at least 6 characters long');
                return false;
            }

            if (newPassword !== confirmNewPassword) {
                alert('New passwords do not match');
                return false;
            }
        }

        return true;
    }
    </script>
</body>
</html>
