<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start(); // Start session here at the top

// Database connection
$servername = "localhost"; 
$username = "root";        
$password = "12345";            
$dbname = "havenist"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'send_otp') {
            $email = $_POST['email'];
            $otp = rand(100000, 999999); // Generate 6-digit OTP
            
            // Start PHPMailer
            $mail = new PHPMailer(true);
            
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'jagadeswararaovana@gmail.com';
                $mail->Password   = 'vienyxievujtsiit';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('jagadeswararaovana@gmail.com', 'Havenist');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = 'Your OTP is: <b>' . $otp . '</b>';
                $mail->AltBody = 'Your OTP is: ' . $otp;

                if ($mail->send()) {
                    $_SESSION['otp'] = $otp;
                    $_SESSION['email'] = $email;

                    echo json_encode(['status' => 'success', 'message' => 'OTP has been sent to your email.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Unable to send OTP.']);
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
            }

        } elseif ($_POST['action'] == 'verify_otp') {
            $input_otp = $_POST['otp'];

            if (isset($_SESSION['otp']) && $_SESSION['otp'] == $input_otp) {
                echo json_encode(['status' => 'success', 'message' => 'OTP verified successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid OTP.']);
            }

        } elseif ($_POST['action'] == 'submit_form') {
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $email = $_SESSION['email'];
            $phone = $_POST['phone'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $check_email_query = "SELECT * FROM users WHERE email = ?";
            $check_stmt = $conn->prepare($check_email_query);
            $check_stmt->bind_param("s", $email);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                echo json_encode(['status' => 'error', 'message' => 'This email is already registered.']);
            } else {
                $sql = "INSERT INTO users (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $password);

                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Form submitted successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Could not save user data.']);
                }

                $stmt->close();
            }

            $check_stmt->close();
        }
    }

    $conn->close();
}
?>
