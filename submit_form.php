<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Email address where to receive messages
    $to = 'autismlyfstyle@gmail.com';

    // Subject of the email
    $subject = 'New Message from Autism Lifestyle Website - Contact Form';

    // Construct the message body
    $body = "Name: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message";

    // Headers
    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        // Redirect back to the contact page with a success message
        header('Location: contact.html?message=sent');
        exit;
    } else {
        // Redirect back to the contact page with an error message
        header('Location: contact.html?message=error');
        exit;
    }
}
?>
