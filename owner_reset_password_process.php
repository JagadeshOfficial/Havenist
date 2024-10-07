<?php
// Database connection
include 'db_connect.php'; // Replace with your actual database connection file

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Validate the token and update the password
    $stmt = $conn->prepare("UPDATE owners SET password = ?, reset_token = NULL WHERE reset_token = ?"); // Ensure using 'owners' table
    $stmt->bind_param("ss", $new_password, $token);

    if ($stmt->execute()) {
        // Return success message as JSON
        echo json_encode(['success' => true, 'message' => "Password has been reset successfully."]);
    } else {
        // Return failure message as JSON
        echo json_encode(['success' => false, 'message' => "Failed to reset password. Please try again."]);
    }
}
?>
