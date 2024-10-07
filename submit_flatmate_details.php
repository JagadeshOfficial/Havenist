<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "1234"; // Replace with your actual database password
$dbname = "havenist"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $age = intval($_POST['age']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $occupation = $conn->real_escape_string($_POST['occupation']);
    $city = $conn->real_escape_string($_POST['city']);
    $sharing_type = $conn->real_escape_string($_POST['sharing_type']);
    $budget = $conn->real_escape_string($_POST['budget']);
    $Localities  = $conn->real_escape_string($_POST['Localities']);
    $lifestyle = $conn->real_escape_string($_POST['lifestyle']);
    $available_from = $conn->real_escape_string($_POST['available_from']);
    $contact_info = $conn->real_escape_string($_POST['contact_info']);
    $description = $conn->real_escape_string($_POST['description']);
    // Initialize an array to store image URLs
    $image_urls = [];

    // Handle multiple image uploads
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            if ($_FILES['images']['error'][$i] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['images']['tmp_name'][$i];
                $file_name = basename($_FILES['images']['name'][$i]);
                $image_url = 'uploads/' . $file_name;

                // Move the file to the "uploads" directory
                if (move_uploaded_file($tmp_name, $image_url)) {
                    $image_urls[] = $image_url; // Add the image path to the array
                } else {
                    echo "Error uploading image: " . $file_name;
                    exit;
                }
            }
        }
    }

    // Convert the array of image URLs to a comma-separated string for storing in the database
    $image_urls_str = implode(',', $image_urls);

    // Insert data into the flatmates table
    $sql = "INSERT INTO flatmates (name, age, gender, occupation, city, sharing_type, budget, Localities, lifestyle, available_from, image_urls, contact_info, description)
            VALUES ('$name', $age, '$gender', '$occupation', '$city', '$sharing_type', '$budget', '$Localities', '$lifestyle', '$available_from', '$image_urls_str', '$contact_info', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Flatmate details added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
