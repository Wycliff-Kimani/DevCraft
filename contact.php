<?php

// Checkinmg if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email address.";
        exit;
    }

    // Email details
    $to      = "Devcraftechnologies@gmail.com";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $fullMessage  = "You have received a new message from your website contact form.\n\n";
    $fullMessage .= "Name: $name\n";
    $fullMessage .= "Email: $email\n";
    $fullMessage .= "Subject: $subject\n";
    $fullMessage .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $fullMessage, $headers)) {
        http_response_code(200);
        echo "Your message has been sent. Thank you!";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong, and we couldn’t send your message.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission. Please try again.";
}
?>
