<?php
session_start();
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Separate first and last name
    $name_parts = explode(' ', $name);
    $first_name = $name_parts[0];
    $last_name = isset($name_parts[1]) ? $name_parts[1] : '';

    // Handle profile photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photoName = basename($_FILES["photo"]["name"]);
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . $photoName;
        
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath);
        
        $query = "UPDATE owners SET first_name = ?, last_name = ?, phone = ?, profile_photo = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $first_name, $last_name, $phone, $photoName, $email);
    } else {
        $query = "UPDATE owners SET first_name = ?, last_name = ?, phone = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $first_name, $last_name, $phone, $email);
    }

    if ($stmt->execute()) {
        // Redirect back to profile page with a success message
        header('Location: owner_profile.php?update=success');
        exit();
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
}

