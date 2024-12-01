<?php
// includes/session.php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit();
    }
}

function login_user($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    
    // Set a cookie that expires when the browser closes
    setcookie('logged_in', 'true', 0, '/');
}

function logout_user() {
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Remove the login cookie
    setcookie('logged_in', '', time() - 3600, '/');
    
    // Redirect to login page
    header("Location: login.php");
    exit();
}