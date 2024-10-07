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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        
        .amenities-section {
            width: 100%;
            max-width: 1400px;
            margin: 20px;
            margin-left: 200px;
            padding: 20px;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        
        .amenities-header {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    border-bottom: 2px solid #e8503a;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.amenities-description {
    font-size: 18px; /* Adjust this value to control font size */
    color: #333;
    margin-top: 10px; /* To add spacing between the line and text */
}

        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }
        
        .amenity-item {
            text-align: center;
            padding: 15px;
            background-color: white;
            border: 1px solid #eee;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .amenity-item img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .amenity-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .amenity-label {
            font-size: 16px;
            color: #555;
        }

        .toggle-section {
            text-align: center;
            margin-top: 20px;
        }

        .toggle-section button {
            background: none;
            border: none;
            color: #e8503a;
            font-weight: bold;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .toggle-section button:hover {
            color: #d73c2f;
        }

        .toggle-section button svg {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }

        .toggle-section button.active svg {
            transform: rotate(180deg);
        }
        /* Hide the extra amenities initially */
        .amenity-item.hidden {
            display: none;
        }
    </style>
</head>
<div class="header">
        <div class="Logo">
            <a href="user_index.html"><img src="Images/Havenist_transparent.png" alt="Havenist"></a>
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
                    <!-- Sign up Dropdown -->
                    <li class="nav-item dropdown" id="signupDropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="signupDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sign up
                        </a>
                        <div class="dropdown-menu" aria-labelledby="signupDropdownMenu">
                            <a class="dropdown-item" href="User_Signup.html">User Signup</a>
                            <a class="dropdown-item" href="Owner_signup.html">Owner Signup</a>
                        </div>
                    </li>
                    <!-- Login Dropdown -->
                    <li class="nav-item dropdown" id="loginDropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdownMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Log in
                        </a>
                        <div class="dropdown-menu" aria-labelledby="loginDropdownMenu">
                            <a class="dropdown-item" href="User_Login.html">User Login</a>
                            <a class="dropdown-item" href="Owner_login.html">Owner Login</a>
                        </div>
                    </li>

                    <!-- user Dashboard Dropdown -->
                    <li class="nav-item dropdown dashboard-menu" id="userDashboardDropdown" style="display: none;">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="Images/img4.jpg" alt="User Profile" class="profile-photo">
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="user_profile.html">User Profile</a>
                            <a class="dropdown-item" href="settings.html">Settings</a>
                            <a class="dropdown-item" href="#" onclick="logout()">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
<body>
<?php
// Connect to your database
$connection = new mysqli("localhost", "root", "1234", "havenist");

// Check if the property ID and type are passed in the URL
if (isset($_GET['propertyType']) && isset($_GET['id'])) {
    $propertyType = $_GET['propertyType'];
    $id = $_GET['id'];
    

    // Based on the type, fetch details from the corresponding table
    if ($propertyType == "properties") {
        $stmt = $connection->prepare("SELECT * FROM pg_hostels WHERE id = ?");
        $stmt->bind_param("i", $id);
    } elseif ($propertyType == "flatmates") {
        $stmt = $connection->prepare("SELECT * FROM flatmates WHERE id = ?");
        $stmt->bind_param("i", $id);
    } elseif ($propertyType == "hotelbooking") {
        $stmt = $connection->prepare("SELECT * FROM hotel_bookings WHERE id = ?");
        $stmt->bind_param("i", $id);
    } else {
        echo "Invalid type.";
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the record exists
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Display the data based on the type
        if ($propertyType == "properties") {
                    echo "<div class='amenities-section'>";
                    echo "<h1 style='color: #2a9d8f; font-size: 54px;  border: 2px solid  black; '><i class='fas fa-home' style='color:#6c757d;'></i>". htmlspecialchars($data['property_name']) . "</h1>";
                    echo "<p class='localities'><b>Localities: </b> " . htmlspecialchars($data['Localities']) . "</p>";
                    echo "<p><b>Sharing Type: </b>" . htmlspecialchars($data['sharing_type']) . "</p>";
                      // Display images
                    // Split images
                    // Display images and videos in the same carousel
                    $images = explode(',', $data['image_urls']);
                    $videos = !empty($data['videos']) ? explode(',', $data['videos']) : [];
                    $carouselId = 'carousel-' . $data['id']; // Unique carousel ID

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

                    echo "<p><b>city: </b>" . htmlspecialchars($data['city']) . "</p>";
                    echo "<p><b>Amount: </b>" . htmlspecialchars($data['price']) . "</p>";
                    echo "<p><b>Facilities: </b>" . htmlspecialchars($data['facilities']) . "</p>";
                    echo "<p><b>Contact: </b> " . htmlspecialchars($data['owner_contact']) . "</p>";
                    //echo "<p><b>property_Type: </b>" . htmlspecialchars($data['propertyType']) . "</p>";
                    echo "<p><b>availability:  </b>" . htmlspecialchars($data['availability']) . "</p>";
                    echo "</div>";
                    echo "<div class='amenities-section'>";
                    echo "<div class='amenities-header'>Description:</div>"; 
                    echo "<div class='amenities-description'>" . htmlspecialchars($data['description']) . "</div>";
                    echo "</div>";
                    echo "</div>";
                }elseif ($propertyType == "flatmates") {
                    echo "<div class='amenities-section'>";
                    echo "<h1>" . htmlspecialchars($data['name']) . "</h1>";
                    echo "<p class='localities'><b>Localities: </b> " . htmlspecialchars($data['Localities']) . "</p>";
                    echo "<p><b>Sharing Type: </b>" . htmlspecialchars($data['sharing_type']) . "</p>";
                      // Display images and videos in the same carousel
                    $images = explode(',', $data['image_urls']);
                    $videos = !empty($data['videos']) ? explode(',', $data['videos']) : [];
                    $carouselId = 'carousel-' . $data['id']; // Unique carousel ID

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
                    echo "<p><b>city: </b>" . htmlspecialchars($data['city']) . "</p>";
                    echo "<p><b>Amount: </b>" . htmlspecialchars($data['budget']) . "</p>";
                  //  echo "<p><b>Facilities: </b>" . htmlspecialchars($data['facilities']) . "</p>";
                    echo "<p><b>Contact: </b> " . htmlspecialchars($data['contact_info']) . "</p>";
                   // echo "<p><b>property_Type: </b>" . htmlspecialchars($data['propertyType']) . "</p>";
                    echo "<p><b>Available from:  </b>" . htmlspecialchars($data['available_from']) . "</p>";
                    echo "</div>";
                    echo "<div class='amenities-section'>";
                    echo "<div class='amenities-header'>Description:</div>"; 
                    echo "<div class='amenities-description'>" . htmlspecialchars($data['description']) . "</div>";
                    echo "</div>";
                    echo "</div>";
                } elseif ($propertyType == "hotelbooking") {
                    echo "<div class='amenities-section'>";
                    echo "<h1>" . htmlspecialchars($data['hotel_name']) . "</h1>";
                    echo "<p class='localities'><b>Localities: </b> " . htmlspecialchars($data['Localities']) . "</p>";
                    echo "<p><b>Sharing Type: </b>" . htmlspecialchars($data['room_type']) . "</p>";
                     // Display images and videos in the same carousel
                    $images = explode(',', $data['image_urls']);
                    $videos = !empty($data['videos']) ? explode(',', $data['videos']) : [];
                    $carouselId = 'carousel-' . $data['id']; // Unique carousel ID

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
                    echo "<p><b>city: </b>" . htmlspecialchars($data['city']) . "</p>";
                    echo "<p><b>Amount: </b>" . htmlspecialchars($data['price_per_night']) . "</p>";
                    echo "<p><b>Facilities: </b>" . htmlspecialchars($data['amenities']) . "</p>";
                    echo "<p><b>Contact: </b> " . htmlspecialchars($data['owner_contact']) . "</p>";
                   // echo "<p><b>property_Type: </b>" . htmlspecialchars($data['propertyType']) . "</p>";
                    echo "<p><b>availability:  </b>" . htmlspecialchars($data['available_rooms']) . "</p>";
                    echo "</div>";
                    echo "<div class='amenities-section'>";
                    echo "<div class='amenities-header'>Description:</div>"; 
                    echo "<div class='amenities-description'>" . htmlspecialchars($data['description']) . "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo ucfirst($propertyType) . " not found.";
            }
        } else {
    echo "No property ID or type provided.";
    }
    // Close the database connection
    $connection->close();
    ?>
    <div class="amenities-section">
    <div class="amenities-header">Common Amenities</div>

    <div class="amenities-grid">
        <div class="amenity-item">
            <img src="Images\icons8-laundry-94.png" alt="Laundry">
            <div class="amenity-label">Laundry</div>
        </div>
        <div class="amenity-item">
            <img src="Images\icons8-warden-80.png" alt="Warden">
            <div class="amenity-label">Warden</div>
        </div>
        <div class="amenity-item hidden">
            <img src="Images\icons8-cleaning-48.png" alt="Room Cleaning">
            <div class="amenity-label">Room Cleaning</div>
        </div>
        <div class="amenity-item">
            <img src="Images\icons8-wifi-48.png" alt="Wifi">
            <div class="amenity-label">Wifi</div>
        </div>
        <div class="amenity-item hidden">
            <img src="Images\icons8-tv-show-48.png" alt="Common TV">
            <div class="amenity-label">Common TV</div>
        </div>
        <div class="amenity-item hidden">
            <img src="Images\icons8-dish-50.png" alt="Mess">
            <div class="amenity-label">Mess</div>
        </div>
        <div class="amenity-item hidden">
            <img src="Images\icons8-refrigerator-48.png" alt="Refrigerator">
            <div class="amenity-label">Refrigerator</div>
        </div>
    </div>
    <div class="toggle-section">
        <button id="toggleButton">
            Show More
            <svg id="toggleIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.854a.5.5 0 0 1 .708 0L8 10.5l5.646-5.646a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
    </div>
</div>

<script>
    const toggleButton = document.getElementById('toggleButton');
    const toggleIcon = document.getElementById('toggleIcon');
    const hiddenItems = document.querySelectorAll('.amenity-item.hidden');
    let isShowingAll = false;
    toggleButton.addEventListener('click', () => {
        if (isShowingAll) {
            // Hide extra items
            hiddenItems.forEach(item => item.style.display = 'none');
            toggleButton.innerHTML = 'Show More';
            toggleButton.appendChild(toggleIcon);
        } else {
            // Show all items
            hiddenItems.forEach(item => item.style.display = 'block');
            toggleButton.innerHTML = 'Show Less';
            toggleButton.appendChild(toggleIcon);
        }

        // Toggle icon rotation
        toggleIcon.classList.toggle('active');

        // Update toggle state
        isShowingAll = !isShowingAll;
    });
</script>
    
</body>
</html>