<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Define your expected username and password
    $expected_username = "admin";
    $expected_password = "password123";

    // Check if the provided username and password match the expected ones
    if ($username === $expected_username && $password === $expected_password) {
        // Redirect to the success page
        header("Location: upload_blog.html");
        exit();
    } else {
        // Redirect to the failure page
        header("Location: login.html");
        exit();
    }
}
?>
