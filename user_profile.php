
<?php
// Start session
session_start();

// Include database connection file
include('db_connect.php');

// Check if the user is logged in and email is set in the session
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    
    // Query to fetch user details
    $query = "SELECT first_name, last_name, email, phone, profile_photo FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();
        $firstName = $user['first_name'];
        $lastName = $user['last_name'];
        $phone = $user['phone'];
        $profilePhoto = $user['profile_photo'];
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "No user is logged in.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            height: auto; /* Ensures it takes up the full viewport height */
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
           
            padding: 20px;
            border-right: 1px solid #ddd;
            box-sizing: border-box;
            position: absolute;
            top: 5px;
            bottom: 0;
            left: 2px;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar ul li a i {
            margin-right: 10px; /* Spacing between the icon and text */
        }

        /* Profile Section */
        .profile-container {
            flex-grow: 1;
            padding: 10px;
            margin-left: 180px; /* Margin to avoid overlap with the fixed sidebar */
            box-sizing: border-box;
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile-header h1 {
            font-size: 24px;
        }

        .profile-form {
            margin-top: 30px;
        }

        .profile-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .profile-form input[type="text"],
        .profile-form input[type="email"],
        .profile-form input[type="tel"] {
            width: 50%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .profile-form .alert {
            color: #d9534f;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .profile-form .whatsapp-section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-form .whatsapp-section input {
            margin-right: 10px;
        }

        .profile-form button {
            padding: 10px 20px;
            background-color: cadetblue;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-form button:hover {
            background-color: #ff4b4b;
        }
        /* Circular Photo Upload */
        .photo-upload-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .photo-upload-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            display: none; /* Initially hidden until a photo is uploaded */
        }

        .photo-upload-circle:hover {
            background-color: #e0e0e0;
        }

        .photo-upload-icon {
            font-size: 24px;
            color: #aaa;
        }

        .photo-input {
            display: none; /* Hide the actual file input */
        }
        
.sidebar ul li a:hover {
    background-color: hsl(253, 7%, 74%);
    color: #fff;
}
        .hidden {
            display: none;
        }
        .profile-photo {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 0px;
        }
        .navbar-nav {
            display: flex;
            align-items: center;
        }
        .property-owner-btn {
            margin-left: 60px;
        }
        .dashboard-menu.active {
            display: block;
        }
        /* Popup Message Styling */
        .popup-message {
            display: none;
            position: fixed;
            top: 40px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
    </style>
</head>

<body style="background-image: none;">
    <!--header-->
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
                    <?php
                    // Assuming you have already fetched the user data
                    $defaultProfilePhoto = 'Images/default_profile.jpg'; // Path to default profile image
                    $profileImage = $profilePhoto ? 'uploads/' . $profilePhoto : $defaultProfilePhoto;
                    ?>
                    <!-- user Dashboard Dropdown -->
                    <li class="nav-item dropdown dashboard-menu" id="userDashboardDropdown" style="display: none;">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= $profileImage ?>" alt="User Profile" class="profile-photo">
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="user_profile.php">User Profile</a>
                            <a class="dropdown-item" href="settings.html">Settings</a>
                            <a class="dropdown-item" href="#" onclick="logout()">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <!-- Popup message -->
    <div id="popupMessage" class="popup-message">Profile updated successfully!</div>
        <!-- Sidebar -->
        <div class="sidebar" style="padding-top:100px">
            <h2>Manage your Account</h2>
            <ul>
                <li><a href="#" onclick="showSection('profile-form')">Basic Profile</a></li>
                <!--<li><a href="#" onclick="showSection('shortlist-section')">Your Shortlists</a></li>
                <li><a href="#">Owners you Contacted</a></li>
                <li><a href="#">Your Payments</a></li>
                <li><a href="#">Your Properties</a></li>
                <li><a href="#">Interested in your Properties</a></li>-->
            </ul>
        </div>
        

        <!-- Profile Section -->
        <div class="profile-container" id="profile-form" style="display: none;">
            <div class="profile-header">
                <h3>Edit Your Profile</h3>
                <!-- Add more options like icons or buttons here if needed -->
            </div>
            <form class="profile-form" action="save_profile.php" method="POST" enctype="multipart/form-data">
        <!-- Photo Upload Field -->
        <div class="photo-upload-circle" onclick="document.getElementById('photo').click();">
            <img id="profileImage" src="<?= $profilePhoto ? 'uploads/' . $profilePhoto : '#' ?>" alt="Profile Photo" style="display: <?= $profilePhoto ? 'block' : 'none' ?>;">
            <i class="fas fa-camera photo-upload-icon" style="display: <?= $profilePhoto ? 'none' : 'block' ?>;"></i>
        </div>
        <input type="file" id="photo" name="photo" class="photo-input" accept="image/*" onchange="previewPhoto(event)">
        
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= $firstName . ' ' . $lastName ?>">
        
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="<?= $email ?>" readonly>
        
        <label for="phone">Mobile Phone</label>
        <input type="tel" id="phone" name="phone" value="<?= $phone ?>">
        
        <div class="whatsapp-section">
            <input type="checkbox" id="whatsapp" name="whatsapp">
            <label for="whatsapp">Get Updates on WhatsApp</label>
        </div>
        
        <button type="submit">Save Profile</button>
    </form>
    <script>
        // Function to show the popup message
        function showPopupMessage() {
            var popup = document.getElementById('popupMessage');
            popup.style.display = 'block';

            // Hide the popup after 3 seconds
            setTimeout(function() {
                popup.style.display = 'none';
            }, 8000);
        }

        // Check if URL contains success message
        window.onload = function() {
            if (window.location.href.indexOf('update=success') !== -1) {
                showPopupMessage();
            }
        };
    </script>
    <script>
        function previewPhoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('profileImage');
        output.src = reader.result;
        output.style.display = 'block';
        document.querySelector('.photo-upload-icon').style.display = 'none';
    };
    reader.readAsDataURL(event.target.files[0]);
}
    </script>
            
        </div>
    
        <!-- Add more sections here if needed, e.g., for shortlists -->
        <div class="profile-container" id="shortlist-section" style="display: none;">
            <h3>Your Shortlists</h3>
            <!-- Your Shortlists content -->
        </div>
    </div>
    <script>
        // Preview the uploaded photo in the circle
        function previewPhoto(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const profileImage = document.getElementById('profileImage');
                profileImage.src = reader.result;
                profileImage.style.display = 'block'; // Show the image
                document.querySelector('.photo-upload-icon').style.display = 'none'; // Hide the icon
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        function showSection(sectionId) {
            // Hide all profile-related sections
            const sections = document.querySelectorAll('.profile-container');
            sections.forEach(section => {
                section.style.display = 'none'; // Hide all sections
            });
        
            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block'; // Show the chosen section
            }
        }
        
        // Optional: Set the default section to display when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            showSection('profile-form'); // Change this to any default section you want to show
        });
        </script>
          <!-- JavaScript to check login status -->
    <script>
        // Check if user is logged in
function checkUserLoginStatus() {
    const userLoggedIn = sessionStorage.getItem('userLoggedIn') === 'true';  // Corrected to 'userLoggedIn'
    
    if (userLoggedIn) {
        // Hide the sign-up and login options
        document.getElementById('signupDropdown').style.display = 'none';
        document.getElementById('loginDropdown').style.display = 'none';

        // Show the user profile dropdown
        document.getElementById('userDashboardDropdown').style.display = 'block';
    }
}

// Call this function on page load
document.addEventListener('DOMContentLoaded', checkUserLoginStatus);

// Logout function
function logout() {
    sessionStorage.removeItem('userLoggedIn'); // Correct to remove 'userLoggedIn'
    window.location.href = 'index.html'; // Redirect to homepage after logout
}

    </script>
   <script>
    function checkLoginStatus() {
        const userLoggedIn = sessionStorage.getItem('userLoggedIn') === 'true';
        const ownerLoggedIn = sessionStorage.getItem('ownerLoggedIn') === 'true';

        if (userLoggedIn || ownerLoggedIn) {
            document.getElementById('signupDropdown').classList.add('hidden');
            document.getElementById('loginDropdown').classList.add('hidden');
        } else {
            document.getElementById('signupDropdown').classList.remove('hidden');
            document.getElementById('loginDropdown').classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', checkLoginStatus);
</script>
</body>
</html>
