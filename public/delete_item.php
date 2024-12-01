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

$sql = "DELETE FROM items WHERE id = $item_id AND user_id = $user_id";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php?message=" . urlencode("Item deleted successfully"));
} else {
    header("Location: dashboard.php?error=" . urlencode("Error deleting item: " . $conn->error));
}
exit();