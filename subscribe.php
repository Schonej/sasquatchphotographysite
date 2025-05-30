<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'leftynation@gmail.com';
    $subject = 'New Booking Request';
    $email = filter_input(INPUT_POST, 'subscribe-email', FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address']);
        exit;
    }
    
    $message = "You have a new booking request from: $email";
    $headers = "From: noreply@yourdomain.com\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();
    
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>