
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Search</title>
    <style>
        

        /* Property Type Buttons Styles */
        .property-type {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .property-type button {
            width: 32%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f1f1f1;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .property-type button:hover, .property-type button.active {
            background-color: #007bff;
            color: #fff;
        }

    /* Filters Styles */
    .container {
    display: flex; /* Use flexbox to align children in a row */
     /* Space between filters and property list */
}

.filters {
    flex: 1; /* Take up 1 part of the available space */
    background-color: #f0f0f0; /* Light background for visibility */
    padding: 15px; /* Padding for aesthetics */
    border-radius: 5px; /* Rounded corners */
}

.property-list {
    flex: 2; /* Take up 2 parts of the available space */
    background-color: #ffffff; /* White background for properties */
    padding: 15px; /* Padding for aesthetics */
    border-radius: 5px; /* Rounded corners */
    max-height: 80vh; /* Set a max height */
    overflow-y: auto; /* Scrollable if content exceeds height */
}

        

        .filters h3 {
            margin-top: -10px;
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .filter-group label {
            display: flex;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .filter-group input[type="checkbox"] {
            margin-right: 2px;
        }

        .filter-group input[type="range"] {
            width: 100%;
        }

        /* Dropdown Filter Styles */
        .AllTypes, .AllLocations {
            margin-left: -180px;
            
        }

        #filter-label {
            display: flex;
            justify-content: space-between;
            margin-left: 50px;
            margin-right: 10px;
            color: #333;
        }
        .search-bar{
            width: 100%;
        }
        .hidden { 
            display: none;
         }
         .amenities-section {
            width: 96%;
            max-width: 800px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .black-link {
    color: black;
    text-decoration: none;
}

    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="Logo">
            <a href="index.html"><img src="Images/Havenist_transparent.png" alt="Company Logo"></a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link pay-rent-box bold-link" href="pay_rent.html">
                            <i class="fas fa-credit-card"></i> Pay Rent
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link property-owner-btn" href="Property_Owners.html">For Property Owners</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="signupDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sign up
                        </a>
                        <div class="dropdown-menu" aria-labelledby="signupDropdown">
                            <a class="dropdown-item" href="User_Signup.html">User Signup</a>
                            <a class="dropdown-item" href="Customer_signup.html">Customer Signup</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Log in
                        </a>
                        <div class="dropdown-menu" aria-labelledby="loginDropdown">
                            <a class="dropdown-item" href="User_Login.html">User Login</a>
                            <a class="dropdown-item" href="Customer_Login.html">Customer Login</a>
                        </div>
                    </li>
                   <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle custom-dropdown-btn" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-menu-button-wide-fill"></i> Menu
                        </a>
                        <div class="dropdown-menu" aria-labelledby="menuDropdown">
                            <a class="dropdown-item" href="About.html">About Us</a>
                            <a class="dropdown-item" href="Property_Owners.html">For Property Owners</a>
                            <a class="dropdown-item" href="Services.html">Services</a>
                            <a class="dropdown-item" href="contact.html">Contact</a>
                        </div>
                    </li>-->
                </ul>
            </div>
         </nav>
    </header>
   
  

    <!-- HTML for the search bar -->
   <!-- <div class="search-bar">
        <form method="GET" action="">
            <input type="text" name="hostelName" placeholder="Hostel Name" value="<?php echo htmlspecialchars($hostelName); ?>">
            <input type="text" name="localities" placeholder="localities" value="<?php echo htmlspecialchars($localities); ?>">
            <button type="submit">Search</button>
        </form>
    </div>-->

    <div class="container">
    <div class="filters">
        <h3>Filters</h3>
        <input type="button" value="Reset Filters" onclick="resetFilters()">
        
        <!-- PG/Hostel Filters -->
        <div class="filter-group pg-hostel-filters">
            <h5>PG/Hostel Filters</h5>
            <label>Sharing Type</label>
            <input type="checkbox" class="sharing-filter" value="1 Share" onchange="applyFilters()"> 1 Share
            <input type="checkbox" class="sharing-filter" value="2 Share" onchange="applyFilters()"> 2 Share
            <input type="checkbox" class="sharing-filter" value="3 Share" onchange="applyFilters()"> 3 Share
            <input type="checkbox" class="sharing-filter" value="4 Share" onchange="applyFilters()"> 4 Share
            <input type="checkbox" class="sharing-filter" value="5 Share" onchange="applyFilters()"> 5 Share
        </div>
        
        <div class="filter-group pg-hostel-filters">
            <label>Price Range</label>
            <input type="range" id="price-range-pg" min="0" max="100000" value="5000" onchange="applyFilters()">
            <span id="price-value-pg">5000</span>
        </div>
        
        <div class="filter-group pg-hostel-filters">
            <label>Facilities</label>
            <input type="checkbox" class="facility-filter" value="Wi-Fi" onchange="applyFilters()"> Wi-Fi
            <input type="checkbox" class="facility-filter" value="AC Rooms" onchange="applyFilters()"> AC Rooms
            <input type="checkbox" class="facility-filter" value="Geyser" onchange="applyFilters()"> Geyser
            <input type="checkbox" class="facility-filter" value="Cupboards" onchange="applyFilters()"> Cupboards
        </div>
        
        <div class="filter-group pg-hostel-filters">
            <label>Availability</label>
            <input type="radio" name="pg-availability" class="availability-filter" value="Immediate" onchange="applyFilters()"> Immediate
            <input type="radio" name="pg-availability" class="availability-filter" value="Within a week" onchange="applyFilters()"> Within a week
            <input type="radio" name="pg-availability" class="availability-filter" value="Within a month" onchange="applyFilters()"> Within a month
            <input type="radio" name="pg-availability" class="availability-filter" value="After a month" onchange="applyFilters()"> After a month
        </div>
        
        <!-- Flatmates Filters -->
        <div class="filter-group flatmates-filters">
            <h5>Flatmates Filters</h5>
            <label>Age Range</label>
            <input type="number" id="age-min" placeholder="Min Age" onchange="applyFilters()">
            <input type="number" id="age-max" placeholder="Max Age" onchange="applyFilters()">
            
            <label>Gender</label>
            <input type="checkbox" class="gender-filter" value="Male" onchange="applyFilters()"> Male
            <input type="checkbox" class="gender-filter" value="Female" onchange="applyFilters()"> Female
            
            <label>Occupation</label>
            <input type="text" class="occupation-filter" placeholder="Occupation" onchange="applyFilters()">
        </div>
        
        <div class="filter-group flatmates-filters">
            <label>Preferred Location</label>
            <input type="text" class="location-filter" placeholder="Preferred Location" onchange="applyFilters()">
        </div>
        
        <div class="filter-group flatmates-filters">
            <label>Budget</label>
            <input type="range" id="budget-range" min="0" max="100000" value="5000" onchange="applyFilters()">
            <span id="budget-value">5000</span>
        </div>
        
        <!-- Hotel Booking Filters -->
        <div class="filter-group hotelbooking-filters">
            <h5>Hotel Booking Filters</h5>
            <label>Room Type</label>
            <input type="checkbox" class="room-type-filter" value="Single" onchange="applyFilters()"> Single
            <input type="checkbox" class="room-type-filter" value="Double" onchange="applyFilters()"> Double
            <input type="checkbox" class="room-type-filter" value="Suite" onchange="applyFilters()"> Suite
        </div>
        
        <div class="filter-group hotelbooking-filters">
            <label>Price Per Night</label>
            <input type="range" id="price-range-hotel" min="0" max="100000" value="5000" onchange="applyFilters()">
            <span id="price-value-hotel">5000</span>
        </div>
        
        <div class="filter-group hotelbooking-filters">
            <label>Amenities</label>
            <input type="checkbox" class="amenities-filter" value="Free Breakfast" onchange="applyFilters()"> Free Breakfast
            <input type="checkbox" class="amenities-filter" value="Wi-Fi" onchange="applyFilters()"> Wi-Fi
            <input type="checkbox" class="amenities-filter" value="Swimming Pool" onchange="applyFilters()"> Swimming Pool
        </div>
        
        <div class="filter-group hotelbooking-filters">
            <label>Available Rooms</label>
            <input type="number" id="available-rooms" placeholder="Number of Rooms" onchange="applyFilters()">
        </div>
    </div>
    <div class="property-list" id="propertyType">
    <div class="property-item1">
    <?php
    // Connect to your database
    $conn = new mysqli("localhost", "root", "1234", "havenist");

    // Check for connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Capture filter input
    $city = isset($_GET['city']) ? $_GET['city'] : '';
    $localities = isset($_GET['localities']) ? $_GET['localities'] : '';
    $property_Type = isset($_GET['property_Type']) ? $_GET['property_Type'] : '';
    $availability = isset($_GET['availability']) ? $_GET['availability'] : '';

    // Set table name based on the propertyType
    $tableName = '';
    if ($property_Type == 'PG/Hostel') {
        $tableName = 'pg_hostels'; // Assuming 'properties' is the table for PG/Hostel
    } elseif ($property_Type == 'Flatmates') {
        $tableName = 'flatmates';
    }elseif ($property_Type == 'hotelbooking') {
        $tableName = 'hotel_bookings';
    } 

    // Only proceed if a valid table is selected
    if (!empty($tableName)) {
        // Construct the SQL query
        $sql = "SELECT * FROM $tableName WHERE 1=1"; // '1=1' makes it easier to append conditions

        // Apply filters
        if (!empty($city)) {
            $sql .= " AND city = '$city'";
        }
        if (!empty($localities)) {
            // Assume localities are entered as comma-separated values
            $localityArray = explode(',', $localities);
            $sql .= " AND (";
            foreach ($localityArray as $index => $locality) {
                $locality = trim($locality);
                if ($index > 0) {
                    $sql .= " OR ";
                }
                $sql .= "localities LIKE '%$locality%'";
            }
            $sql .= ")";
        }
       /* if (!empty($availability)) {
            $sql .= " AND availability = '$availability'";
        }
*/
        // Execute the query
        $result = $conn->query($sql);

        // Display the results
        if ($result->num_rows > 0) {
            echo "<div class='properties-list'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='property-item , amenities-section'>";    
                // Display fields based on the selected property type
                if ($property_Type == 'PG/Hostel') {
                    echo "<h3 ><a href='property_details.php?propertyType=properties&id=" . $row['id'] . "'>" . $row['property_name'] . "</a></h3>";  
                    echo "<p><a href='property_details.php?propertyType=properties&id=" . $row['id'] . "' class='black-link'' ><b>Localities: </b>" . $row['Localities'] . "</a></p>";
                    echo "<hr>";
                    // Display images and videos in the same carousel
$images = !empty($row['image_urls']) ? explode(',', $row['image_urls']) : [];
$videos = !empty($row['videos']) ? explode(',', $row['videos']) : [];
$carouselId = 'carousel-' . $row['id']; // Unique carousel ID

// Combine images and videos in one array
$mediaItems = array_merge($images, $videos);

// Check if there's more than one media item (image or video)
if (count($mediaItems) > 1) {
    // More than one media item, display carousel
    echo "<div id='$carouselId' class='carousel slide' data-bs-ride='carousel' style='width: 300px; height: 200px;'>
            <div class='carousel-inner' style='width: 300px; height: 200px;'>";

    foreach ($mediaItems as $index => $item) {
        $isImage = strpos($item, '.mp4') === false; // Check if the media item is an image or a video
        echo "<div class='carousel-item " . ($index === 0 ? 'active' : '') . "'>";

        if ($isImage) {
            // Display image with click to open modal
            echo "<img src='" . $item . "' class='d-block w-100' alt='Property Image' style='height:200px; width:300px; object-fit:cover;' 
                    data-bs-toggle='modal' data-bs-target='#mediaModal' onclick='openModal(\"" . $item . "\", true)'/>";
        } else {
            // Display video with click to open modal
            echo "<video width='300px' height='200px' controls style='object-fit:cover;'
                    data-bs-toggle='modal' data-bs-target='#mediaModal' onclick='openModal(\"" . $item . "\", false)'>
                    <source src='" . $item . "' type='video/mp4'>
                </video>";
        }

        echo "</div>";
    }

    echo "</div>
        <button class='carousel-control-prev' type='button' data-bs-target='#$carouselId' data-bs-slide='prev' style='height: 100%;'>
            <span class='carousel-control-prev-icon' aria-hidden='true' style='height: 50px; width: 50px;'></span>
            <span class='visually-hidden'>Previous</span>
        </button>
        <button class='carousel-control-next' type='button' data-bs-target='#$carouselId' data-bs-slide='next' style='height: 100%;'>
            <span class='carousel-control-next-icon' aria-hidden='true' style='height: 50px; width: 50px;'></span>
            <span class='visually-hidden'>Next</span>
        </button>
    </div>";
} else {
    // Only one image or video, display it directly
    if (!empty($images[0])) {
        // Display single image with click to open modal
        echo "<img src='" . $images[0] . "' alt='Property Image' style='width:300px; height:200px; padding:5px' 
                data-bs-toggle='modal' data-bs-target='#mediaModal' onclick='openModal(\"" . $images[0] . "\", true)'/>";
    } elseif (!empty($videos[0])) {
        // Display single video with click to open modal
        echo "<video width='300px' height='200px' controls style='object-fit:cover;' 
                data-bs-toggle='modal' data-bs-target='#mediaModal' onclick='openModal(\"" . $videos[0] . "\", false)'>
                <source src='" . $videos[0] . "' type='video/mp4'>
            </video>";
    }
}
echo "<hr>";
                    // Deposit, Rent and Room Type
                    echo "<span style='display: flex; justify-content: space-between; padding: 10px 0;'>";
                    echo "<span><p><a href='property_details.php?propertyType=properties&id=" . $row['id'] . "' class='black-link'' ><b>Deposit</b></p><p>" . $row['updated_at'] . "</a></p></span>";
                    echo "<span><p><a href='property_details.php?propertyType=properties&id=" . $row['id'] . "' class='black-link'' ><b>Room Type Available</b></p><p>" . $row['sharing_type'] . "</a></p></span>";
                    echo "<span><p><a href='property_details.php?propertyType=properties&id=" . $row['id'] . "' class='black-link'' ><b>Rent/Month</b></p><p>₹". $row['price'] ."</p></a></span>";
                    echo "</span>";
                    echo "<hr>";
                    // Get Details Button and Like Icon Box
                    echo "<div style='display: flex; justify-content: space-between; align-items: center;'>";
                    echo "<button onclick=\"window.location.href='property_details.php?propertyType=properties&id=" . $row['id'] . "'\" style='background-color: #f65b5b; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;'>Get Owner Details</button>";
                    // Like Icon with onclick to redirect to owner_profile.php
                    echo "<div class='like-icon' data-bs-toggle='tooltip' title='Click to Shortlist' onclick=\"window.location.href='owner_profile.php'\" style='border: 1px solid #ddd; padding: 8px; border-radius: 5px; cursor: pointer; display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; background-color: #f8f8f8;'>
                        <i class='bi bi-heart' style='font-size: 18px; color: #f65b5b;'></i>
                        </div>";
                    echo "</div>";
                    echo "</div>";
                } elseif ($property_Type == 'Flatmates') {
                    echo "<h3><a href='property_details.php?propertyType=flatmates&id=" . $row['id'] . "'>" . $row['name'] . "</a></h3>";     
                    echo "<p><a href='property_details.php?propertyType=properties&id=" . $row['id'] . "' class='black-link'' ><b>Localities: </b>" . $row['Localities'] . "</p>";
                    echo "<hr>";
                    // Display images and videos in the same carousel
                    // Check if image_url is not empty or null before exploding
                    $images = !empty($row['image_urls']) ? explode(',', $row['image_urls']) : [];
                    $videos = !empty($row['videos']) ? explode(',', $row['videos']) : [];
                    $carouselId = 'carousel-' . $row['id']; // Unique carousel ID

                    // Combine images and videos in one array
                    $mediaItems = array_merge($images, $videos);

                    // Check if there's more than one media item (image or video)
                    if (count($mediaItems) > 1) {
                        // More than one media item, display carousel
                        echo "<div id='$carouselId' class='carousel slide' data-bs-ride='carousel' style='width: 300px; height: 200px;'>
                                <div class='carousel-inner' style='width: 300px; height: 200px;'>";

                        foreach ($mediaItems as $index => $item) {
                            $isImage = strpos($item, '.mp4') === false; // Check if the media item is an image or a video
                            echo "<div class='carousel-item " . ($index === 0 ? 'active' : '') . "'>";
                            
                            if ($isImage) {
                                // Display image
                                echo "<img src='" . $item . "' class='d-block w-100' alt='Property Image' style='height:200px; width:300px; object-fit:cover;'/>";
                            } else {
                                // Display video
                                echo "<video width='300px' height='200px' controls style='object-fit:cover;'>
                                        <source src='" . $item . "' type='video/mp4'>
                                    </video>";
                            }

                            echo "</div>";
                        }

                        echo "</div>
                            <button class='carousel-control-prev' type='button' data-bs-target='#$carouselId' data-bs-slide='prev' style='height: 100%;'>
                                <span class='carousel-control-prev-icon' aria-hidden='true' style='height: 50px; width: 50px;'></span>
                                <span class='visually-hidden'>Previous</span>
                            </button>
                            <button class='carousel-control-next' type='button' data-bs-target='#$carouselId' data-bs-slide='next' style='height: 100%;'>
                                <span class='carousel-control-next-icon' aria-hidden='true' style='height: 50px; width: 50px;'></span>
                                <span class='visually-hidden'>Next</span>
                            </button>
                        </div>";
                    } else {
                        // Only one image or video, display it directly
                        if (!empty($images[0])) {
                            // Display single image
                            echo "<img src='" . $images[0] . "' alt='Property Image' style='width:300px; height:200px; padding:5px'/>";
                        } elseif (!empty($videos[0])) {
                            // Display single video
                            echo "<video width='300px' height='200px' controls style='object-fit:cover;'>
                                    <source src='" . $videos[0] . "' type='video/mp4'>
                                </video>";
                        }
                    }
                     echo "<p><b>Sharing Type: </b>" . $row['sharing_type'] . "</p>";
                    echo "<p><b>city: </b>" . $row['city'] . "</p>";
                    echo "<p><b>Price: </b>" . $row['budget'] . "</p>";
                    //echo "<p><b>Facilities: </b>" . $row['facilities'] . "</p>";
                    echo "<p><b>Contact: </b> " . $row['contact_info'] . "</p>";
                   // echo "<p><b>property_Type: </b>" . $row['propertyType'] . "</p>";
                    echo "<p><b>availability:  </b>" . $row['available_from'] . "</p>";
                    // Get Details Button and Like Icon Box
                    echo "<div style='display: flex; align-items: center; gap: 10px;'>";
                    echo "<button onclick=\"window.location.href='property_details.php?propertyType=flatmates&id=" . $row['id'] . "'\" style='background-color: #f65b5b; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;'>Get Owner Details</button>";
                    echo "<div class='like-icon' data-bs-toggle='tooltip' title='Click to Shortlist' style='border: 1px solid #ddd; padding: 8px; border-radius: 5px; cursor: pointer; display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; background-color: #f8f8f8;'>";
                    echo "<i class='bi bi-heart' style='font-size: 18px; color: #f65b5b;'></i>";  // Bootstrap Icons heart inside a box
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } elseif ($property_Type == 'hotelbooking') {
                    echo "<h3><a href='property_details.php?propertyType=hotelbooking&id=" . $row['id'] . "'>" . $row['hotel_name'] . "</a></h3>";  
                    echo "<p><b>Localities: </b> " . $row['Localities'] . "</p>";
                    echo "<hr>";
                    echo "<p><b>Room Type: </b>" . $row['room_type'] . "</p>";
                    //echo "<p><b>Price: </b>" . $row['price'] . "</p>";
                    // Display images and videos in the same carousel
                    // Check if image_url is not empty or null before exploding
                    $images = !empty($row['image_urls']) ? explode(',', $row['image_urls']) : [];
                    $videos = !empty($row['videos']) ? explode(',', $row['videos']) : [];
                    $carouselId = 'carousel-' . $row['id']; // Unique carousel ID

                    // Combine images and videos in one array
                    $mediaItems = array_merge($images, $videos);

                    // Check if there's more than one media item (image or video)
                    if (count($mediaItems) > 1) {
                        // More than one media item, display carousel
                        echo "<div id='$carouselId' class='carousel slide' data-bs-ride='carousel' style='width: 300px; height: 200px;'>
                                <div class='carousel-inner' style='width: 300px; height: 200px;'>";

                        foreach ($mediaItems as $index => $item) {
                            $isImage = strpos($item, '.mp4') === false; // Check if the media item is an image or a video
                            echo "<div class='carousel-item " . ($index === 0 ? 'active' : '') . "'>";
                            
                            if ($isImage) {
                                // Display image
                                echo "<img src='" . $item . "' class='d-block w-100' alt='Property Image' style='height:200px; width:300px; object-fit:cover;'/>";
                            } else {
                                // Display video
                                echo "<video width='300px' height='200px' controls style='object-fit:cover;'>
                                        <source src='" . $item . "' type='video/mp4'>
                                    </video>";
                            }

                            echo "</div>";
                        }

                        echo "</div>
                            <button class='carousel-control-prev' type='button' data-bs-target='#$carouselId' data-bs-slide='prev' style='height: 100%;'>
                                <span class='carousel-control-prev-icon' aria-hidden='true' style='height: 50px; width: 50px;'></span>
                                <span class='visually-hidden'>Previous</span>
                            </button>
                            <button class='carousel-control-next' type='button' data-bs-target='#$carouselId' data-bs-slide='next' style='height: 100%;'>
                                <span class='carousel-control-next-icon' aria-hidden='true' style='height: 50px; width: 50px;'></span>
                                <span class='visually-hidden'>Next</span>
                            </button>
                        </div>";
                    } else {
                        // Only one image or video, display it directly
                        if (!empty($images[0])) {
                            // Display single image
                            echo "<img src='" . $images[0] . "' alt='Property Image' style='width:300px; height:200px; padding:5px'/>";
                        } elseif (!empty($videos[0])) {
                            // Display single video
                            echo "<video width='300px' height='200px' controls style='object-fit:cover;'>
                                    <source src='" . $videos[0] . "' type='video/mp4'>
                                </video>";
                        }
                    }
                    echo "<p><b>city: </b>" . $row['city'] . "</p>";
                    echo "<p><b>Price: </b>" . $row['price_per_night'] . "</p>";
                    echo "<p><b>Facilities: </b>" . $row['amenities'] . "</p>";
                    echo "<p><b>Contact: </b> " . $row['owner_contact'] . "</p>";
                    echo "<p><b>property_Type: </b>" . $row['propertyType'] . "</p>";
                    echo "<p><b>available_rooms:  </b>" . $row['available_rooms'] . "</p>";
                    // Get Details Button and Like Icon Box
                    echo "<div style='display: flex; align-items: center; gap: 10px;'>";
                    echo "<button onclick=\"window.location.href='property_details.php?propertyType=hotelbooking&id=" . $row['id'] . "'\" style='background-color: #f65b5b; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;'>Get Owner Details</button>";
                    echo "<div class='like-icon' data-bs-toggle='tooltip' title='Click to Shortlist' style='border: 1px solid #ddd; padding: 8px; border-radius: 5px; cursor: pointer; display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; background-color: #f8f8f8;'>";
                    echo "<i class='bi bi-heart' style='font-size: 18px; color: #f65b5b;'></i>";  // Bootstrap Icons heart inside a box
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }        
            }
            echo "</div>";
        } else {
            echo "No properties found.";
        }
    } else {
        echo "Invalid property type selected.";
    }

    $conn->close();
    ?>
    </div>
</div>
</div>
<!-- Bootstrap Modal for Enlarged Media -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body" style="text-align:center;">
        <!-- Media content will be loaded dynamically here -->
        <img id="modalImage" style="width: 100%; height: auto; display:none;" alt="Large Media">
        <video id="modalVideo" controls style="width: 100%; height: auto; display:none;">
          <source id="modalVideoSource" type="video/mp4">
        </video>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// JavaScript to handle opening media in the modal
function openModal(mediaUrl, isImage) {
    if (isImage) {
        document.getElementById('modalImage').src = mediaUrl;
        document.getElementById('modalImage').style.display = 'block';
        document.getElementById('modalVideo').style.display = 'none';
    } else {
        document.getElementById('modalVideoSource').src = mediaUrl;
        document.getElementById('modalVideo').load();
        document.getElementById('modalVideo').style.display = 'block';
        document.getElementById('modalImage').style.display = 'none';
    }
}
</script>
<script>
function resetFilters() {
    // Reset all checkbox inputs
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
        checkbox.checked = false; // Uncheck all checkboxes
    });

    // Reset all radio inputs
    const radios = document.querySelectorAll('input[type="radio"]');
    radios.forEach((radio) => {
        radio.checked = false; // Uncheck all radio buttons
    });

    // Reset price range slider
    const priceRange = document.getElementById('price-range');
    priceRange.value = 5000; // Reset to default value (or any other default you want)
    document.getElementById('price-value').innerText = priceRange.value; // Update displayed price value

    // Optionally, you can also call applyFilters() if you want to refresh the displayed properties
    applyFilters(); // Call to refresh the properties based on reset filters
}

// Function to display the price value of the range input
document.getElementById('price-range').addEventListener('input', function () {
    document.getElementById('price-value').innerText = this.value; // Update displayed price value
});
function resetFilters() {
    // Logic to reset all filters to their default state
    document.querySelectorAll('.filters input').forEach(input => {
        input.checked = false;
        if (input.type === 'range') {
            input.value = input.min; // Reset to minimum
        }
    });
    document.getElementById('price-value-pg').textContent = 5000; // Reset price display
    document.getElementById('budget-value').textContent = 5000; // Reset budget display
}
</script>

   

    </div>   
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
    </script>
        <script>
        // Function to hide all filters
        function hideAllFilters() {
            document.querySelectorAll('.filter-group').forEach(filterGroup => {
                filterGroup.classList.add('hidden');
            });
        }

        // Function to show filters based on property type
        function showFilters(filters) {
            filters.forEach(filter => {
                filter.classList.remove('hidden');
            });
        }

        // Get the property type from PHP and show the relevant filters
        const propertyType = '<?php echo $property_Type; ?>';

        hideAllFilters();  // Hide all filters initially

        if (propertyType === 'PG/Hostel') {
            showFilters(document.querySelectorAll('.pg-hostel-filters'));
        } else if (propertyType === 'Flatmates') {
            showFilters(document.querySelectorAll('.flatmates-filters'));
        } else if (propertyType === 'hotelbooking') {
            showFilters(document.querySelectorAll('.hotelbooking-filters'));
        }
        </script>
        <script>
function applyFilters() {
    // Get selected filter values
    const propertyType = document.getElementById('propertyType').value;
    const priceRange = document.getElementById('price-range').value;
    const sharingTypes = Array.from(document.querySelectorAll('.sharing-filter:checked')).map(checkbox => checkbox.value);
    const facilities = Array.from(document.querySelectorAll('.facility-filter:checked')).map(checkbox => checkbox.value);
    const availability = document.querySelector('input[name="pg-availability"]:checked')?.value;

    // Create an object with the filter values
    const filters = {
        propertyType,
        priceRange,
        sharingTypes,
        facilities,
        availability
    };

    // Send the filter data to the server using fetch (AJAX)
    fetch('fetch_properties.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(filters), // Send filters as JSON
    })
    .then(response => response.text()) // Parse response as text (HTML content)
    .then(data => {
        // Update the property list with the filtered data
        document.querySelector('.property-list').innerHTML = data;
    })
    .catch(error => console.error('Error fetching properties:', error));
}
</script> 
</body>
</html>