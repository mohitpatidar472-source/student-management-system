<?php
// check_otp.php -- Step 4: otp_verify table se OTP match karta hai
session_start();
include 'db.php';

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_email.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_SESSION['reset_email'];
    $enteredOtp = trim($_POST['otp']);
    $now = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("SELECT id FROM otp_verify WHERE email = ? AND otp = ? AND is_used = 0 AND expires_at >= ?");
    $stmt->bind_param("sss", $email, $enteredOtp, $now);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        // OTP ko used mark kar do taaki dobara use na ho
        $update = $conn->prepare("UPDATE otp_verify SET is_used = 1 WHERE id = ?");
        $update->bind_param("i", $row['id']);
        $update->execute();

        // OTP verified flag session me set karo
        $_SESSION['otp_verified'] = true;

        header("Location: reset_password.php");
        exit();

    } else {
        $_SESSION['error'] = "Galat ya expire ho chuka OTP hai. Dobara try karein.";
        header("Location: verify_otp.php");
        exit();
    }
}
?>