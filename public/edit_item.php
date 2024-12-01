<?php
require_once '../includes/session.php';
require_once '../config/database.php';


require_login();

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$item_id = $conn->real_escape_string($_GET['id']);
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM items WHERE id = $item_id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: dashboard.php");
    exit();
}

$item = $result->fetch_assoc();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);

    if (empty($name)) {
        $error = "Item name is required";
    } else {
        $update_sql = "UPDATE items SET name = '$name', description = '$description' WHERE id = $item_id";
        
        if ($conn->query($update_sql) === TRUE) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error: " . $update_sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Edit Item</h1>
        
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <form method="post" onsubmit="return validateItemForm()">
            <input type="text" name="name" placeholder="Item Name" 
                   value="<?php echo htmlspecialchars($item['name']); ?>" required>
            <textarea name="description" placeholder="Item Description"><?php 
                echo htmlspecialchars($item['description']); 
            ?></textarea>
            <button type="submit">Update Item</button>
        </form>
        
        <a href="dashboard.php" class="btn">Back to Dashboard</a>
    </div>
    <script src="assets/js/validation.js"></script>
</body>
</html>