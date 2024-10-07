<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start(); // Start session

// Database connection
include 'db_connect.php'; // Replace with your actual database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generate a unique token

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Store the token in the database
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Send the email using PHPMailer
        $resetLink = "http://localhost:8000/user_reset_password.php?token=" . $token; // Adjust the port and URL as needed
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: " . $resetLink;

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jagadeswararaovana@gmail.com'; // Your Gmail address
        $mail->Password = 'vienyxievujtsiit'; // Use an App Password instead of your actual password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('jagadeswararaovana@gmail.com', 'Havenist');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            echo json_encode(['status' => 'success', 'message' => 'Reset link sent to your email.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send email.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
    }
}
?>
