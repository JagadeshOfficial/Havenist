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
    $hotel_name = $conn->real_escape_string($_POST['hotel_name']);
    $Localities = $conn->real_escape_string($_POST['Localities']);
    $price_per_night = $conn->real_escape_string($_POST['price_per_night']);
    $room_type = $conn->real_escape_string($_POST['room_type']);
    $amenities = $conn->real_escape_string($_POST['amenities']);
    $total_rooms = intval($_POST['total_rooms']);
    $available_rooms = intval($_POST['available_rooms']);
    $owner_name = $conn->real_escape_string($_POST['owner_name']);
    $owner_contact = $conn->real_escape_string($_POST['owner_contact']);
    $city = $conn->real_escape_string($_POST['city']);
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

    // Insert data into the hotels table (assuming you have a `hotels` table)
    $sql = "INSERT INTO hotel_bookings (hotel_name, Localities, price_per_night, room_type, amenities, total_rooms, available_rooms, image_urls, owner_name, owner_contact,city,description)
            VALUES ('$hotel_name', '$Localities', '$price_per_night', '$room_type', '$amenities', $total_rooms, $available_rooms, '$image_urls_str', '$owner_name', '$owner_contact','$city','$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Hotel details added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

