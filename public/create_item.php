<?php
require_once '../includes/session.php';
require_once '../config/database.php';

require_login();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $user_id = $_SESSION['user_id'];

    if (empty($name)) {
        $error = "Item name is required";
    } else {
        $sql = "INSERT INTO items (user_id, name, description) VALUES ($user_id, '$name', '$description')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Item</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Create New Item</h1>
        
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <form method="post" onsubmit="return validateItemForm()">
            <input type="text" name="name" placeholder="Item Name" required>
            <textarea name="description" placeholder="Item Description"></textarea>
            <button type="submit">Create Item</button>
        </form>
        
        <a href="dashboard.php" class="btn">Back to Dashboard</a>
    </div>
    <script src="assets/js/validation.js"></script>
</body>
</html>