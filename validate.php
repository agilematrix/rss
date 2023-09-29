<?php
// validate.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check the username and password (replace with your validation logic)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace the following condition with your actual validation logic
    if ($username === 'scpc' && $password === '12345') {
        // Redirect to dashboard.php
        header('Location: dashboard.php');
        exit;
    } else {
        // Invalid credentials, redirect back to index.php with an error parameter
        header('Location: index.php?error=1');
        exit;
    }
} else {
    // If the form is not submitted, redirect to index.php
    header('Location: index.php');
    exit;
}
?>
