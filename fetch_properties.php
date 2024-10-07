<?php
// Connect to your database
$conn = new mysqli("localhost", "root", "12345", "havenist");

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the filter data from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['propertyType']) && !empty($data['propertyType'])) {
    // Get filter inputs from the request
    $propertyType = htmlspecialchars($data['propertyType']);
    $priceRange = isset($data['priceRange']) ? $data['priceRange'] : '';
    $sharingTypes = isset($data['sharingTypes']) ? $data['sharingTypes'] : array();
    $facilities = isset($data['facilities']) ? $data['facilities'] : array();
    $availability = isset($data['availability']) ? $data['availability'] : '';

    // Determine the table name based on property type
    $tableName = '';
    if ($propertyType == 'PG/Hostel') {
        $tableName = 'pg_hostels';
    } elseif ($propertyType == 'Flatmates') {
        $tableName = 'flatmates';
    } elseif ($propertyType == 'hotelbooking') {
        $tableName = 'hotelbooking';
    }

    // Make sure we have a valid table name
    if (!empty($tableName)) {
        // Start building the SQL query
        $sql = "SELECT * FROM $tableName WHERE 1=1";

        // Apply filters dynamically
        if (!empty($priceRange)) {
            $priceRange = intval($priceRange); // Ensure it's an integer
            $sql .= " AND price <= $priceRange";
        }

        if (!empty($sharingTypes)) {
            $sharingTypes = array_map('htmlspecialchars', $sharingTypes); // Sanitize each value
            $sharingTypesList = implode("','", $sharingTypes); // Convert array to a comma-separated string
            $sql .= " AND sharing_type IN ('$sharingTypesList')";
        }

        if (!empty($facilities)) {
            foreach ($facilities as $facility) {
                $facility = htmlspecialchars($facility); // Sanitize each facility
                $sql .= " AND facilities LIKE '%$facility%'";
            }
        }

        if (!empty($availability)) {
            $availability = htmlspecialchars($availability); // Sanitize the input
            $sql .= " AND availability = '$availability'";
        }

        // Execute the SQL query
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Loop through results and display the properties
            while ($row = $result->fetch_assoc()) {
                echo "<div class='property-item'>";
                echo "<h3>" . htmlspecialchars($row['property_name']) . "</h3>";
                echo "<p>Price: " . htmlspecialchars($row['price']) . "</p>";
                echo "<p>Facilities: " . htmlspecialchars($row['facilities']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "No properties found matching your filters.";
        }
    } else {
        echo "Invalid property type selected.";
    }
} else {
    echo "No property type selected.";
}

$conn->close();
?>
