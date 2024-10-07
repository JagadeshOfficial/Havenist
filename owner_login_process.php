<?php
session_start();
include('db_connect.php');

    // Capture login data
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Verify owner login credentials
    if (!empty($email) && !empty($password)) {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM owners WHERE email = ?");
        
        if ($stmt === false) {
            echo json_encode(['status' => 'error', 'message' => 'SQL preparation failed']);
            exit();
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

    // Check if email exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            // Set session variables for logged-in user
            $_SESSION['ownerLoggedIn'] = true; 
            $_SESSION['email'] = $row['email'];  // Store user email in session
            $_SESSION['first_name'] = $row['first_name']; // Store first name for display in profile, optional

            // Send success response for AJAX
            echo json_encode(['status' => 'success']);
        } else {
            // Invalid password response
            echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
        }
    } else {
        // Invalid email response
        echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
    }
    $stmt->close();
    } else {
    // Error response if email or password is missing
    echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
    }

    $conn->close();
    ?>