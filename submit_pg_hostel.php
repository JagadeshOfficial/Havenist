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
    $property_name = $conn->real_escape_string($_POST['property_name']);
    $property_type = $conn->real_escape_string($_POST['property_type']);
    $city = $conn->real_escape_string($_POST['city']);
    $price = $conn->real_escape_string($_POST['price']);
    $sharing_type = $conn->real_escape_string($_POST['sharing_type']);
    $facilities = $conn->real_escape_string($_POST['facilities']);
    $address = $conn->real_escape_string($_POST['address']);
   // $area_size = intval($_POST['area_size']);
    $availability  = $conn->real_escape_string($_POST['availability']);
    $owner_name = $conn->real_escape_string($_POST['owner_name']);
    $owner_contact = $conn->real_escape_string($_POST['owner_contact']);
    $Localities = $conn->real_escape_string($_POST['Localities']);
    $description  = $conn->real_escape_string($_POST['description']);
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

    // Insert data into the pg_hostels table (assuming you have a `pg_hostels` table)
    $sql = "INSERT INTO pg_hostels (property_name, property_type, city, price, sharing_type, facilities, address, availability, image_urls, owner_name, owner_contact, Localities, description)
            VALUES ('$property_name', '$property_type', '$city', '$price', '$sharing_type', '$facilities', '$address', '$availability', '$image_urls_str', '$owner_name', '$owner_contact', '$Localities','$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Property details added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

