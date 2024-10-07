<?php
// Database connection
include 'db_connect.php'; // Replace with your actual database connection file

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the token
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Invalid or expired token.";
        exit;
    }
} else {
    echo "No token provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>


    <div class="container">
        <h2>Reset Password</h2>
        <form id="resetPasswordForm" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="form-group">
                <input type="password" class="form-control" name="new_password" placeholder="Enter new password" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
            <div id="responseMessage"></div>
        </form>
    </div>

    <script>
    document.getElementById('resetPasswordForm').onsubmit = function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        fetch('user_reset_password_process.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Display success message
                document.getElementById('responseMessage').innerHTML = `<p>${data.message}</p>`;
                
                // Display login button
                var loginButton = document.createElement('button');
                loginButton.innerText = 'Go to Login';
                loginButton.className = 'btn btn-secondary';
                loginButton.onclick = function() {
                    window.location.href = 'user_login.html'; // Change to your actual login page
                };

                // Append the login button
                document.getElementById('responseMessage').appendChild(loginButton);
            } else {
                // Display failure message
                document.getElementById('responseMessage').innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            document.getElementById('responseMessage').innerText = 'Error occurred: ' + error;
        });
    };
    </script>

    </>
</body>
</html>
