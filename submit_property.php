<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost"; 
$username = "root"; 
$password = "12345"; 
$dbname = "havenist"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize common input data
    $property_type = $conn->real_escape_string(trim($_POST['form_type']));
    $city = $conn->real_escape_string(trim($_POST['city']));
    $owner_name = $conn->real_escape_string(trim($_POST['owner_name']));
    $owner_contact = $conn->real_escape_string(trim($_POST['owner_contact']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $bhk_type = $conn->real_escape_string(trim($_POST['bhk_type'])); // BHK Type added

    // Ensure the uploads directory exists
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true);
    }

    // Handle based on form type
    if ($property_type == 'hotelbooking') {
        // Specific fields for Hotel Booking
        $hotel_name = $conn->real_escape_string(trim($_POST['hotelName']));
        $price = $conn->real_escape_string(trim($_POST['price']));
        $facilities = $conn->real_escape_string(trim($_POST['facilities']));
        $location = $conn->real_escape_string(trim($_POST['location']));
        $availability = $conn->real_escape_string(trim($_POST['availability']));
        $image_urls = implode(',', $_FILES['images']['name']); // Handle images
        $contact = $conn->real_escape_string(trim($_POST['contact']));

        // Move uploaded images
        foreach ($_FILES['images']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['images']['tmp_name'][$key];
                $target_file = 'uploads/' . basename($_FILES['images']['name'][$key]);
                move_uploaded_file($tmp_name, $target_file);
            }
        }

        // SQL query to insert data into hotel_booking table
        $sql = "INSERT INTO hotel_booking (hotel_name, city, bhk_type, price, facilities, localities, availability, owner_name, owner_contact, description, image_url)
                VALUES ('$hotel_name', '$city', '$bhk_type', '$price', '$facilities', '$location', '$availability', '$owner_name', '$owner_contact', '$description', '$image_urls')";

    } elseif ($property_type == 'flatmates') {
        // Specific fields for Flatmates
        $flatmate_name = $conn->real_escape_string(trim($_POST['flatmateName']));
        $price = $conn->real_escape_string(trim($_POST['price']));
        $facilities = $conn->real_escape_string(trim($_POST['facilities']));
        $location = $conn->real_escape_string(trim($_POST['location']));
        $availability = $conn->real_escape_string(trim($_POST['availability']));
        $image_urls = implode(',', $_FILES['images']['name']); // Handle images

        // Move uploaded images
        foreach ($_FILES['images']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['images']['tmp_name'][$key];
                $target_file = 'uploads/' . basename($_FILES['images']['name'][$key]);
                move_uploaded_file($tmp_name, $target_file);
            }
        }

        // SQL query to insert data into flatmates table
        $sql = "INSERT INTO flatmates (flatmate_name, city, price, sharing_type, facilities, localities, availability, owner_name, owner_contact, description, image_url)
                VALUES ('$flatmate_name', '$city', '$price', '{$_POST['sharingType']}', '$facilities', '$location', '$availability', '$owner_name', '$owner_contact', '$description', '$image_urls')";
    
    } elseif ($property_type == 'pgHostel') {
        // Specific fields for PG/Hostel
        $property_name = $conn->real_escape_string(trim($_POST['property_name']));
        $price = $conn->real_escape_string(trim($_POST['price']));
        $sharing_type = $conn->real_escape_string(trim($_POST['sharing_type']));
        $facilities = $conn->real_escape_string(trim($_POST['facilities']));
        $address = $conn->real_escape_string(trim($_POST['address']));
        $area_size = $conn->real_escape_string(trim($_POST['area_size']));
        $availability = $conn->real_escape_string(trim($_POST['availability']));
        $image_url = $conn->real_escape_string(trim($_POST['image_url']));

        // SQL query to insert data into pg_hostels table
        $sql = "INSERT INTO pg_hostels (property_name, property_type, city, price, sharing_type, facilities, address, area_size, availability, image_url, owner_name, owner_contact, description)
                VALUES ('$property_name', 'Hostel', '$city', '$price', '$sharing_type', '$facilities', '$address', '$area_size', '$availability', '$image_url', '$owner_name', '$owner_contact', '$description')";
    }

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "New property added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
