<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $to = "admin@gmail.com.com"; 
    $subject = "Contact Form Submission from " . $name;
    $headers = "From: " . $email;

    if (mail($to, $subject, $message, $headers)) {
        $success = "Your message has been sent successfully.";
    } else {
        $error = "There was an error sending your message.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="contact-container">
        <h1>Contact Us</h1>

        <?php if (isset($success)): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="post" action="contact.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <a href="index.php" class="btn">Home</a>
    </div>
</body>
</html>
