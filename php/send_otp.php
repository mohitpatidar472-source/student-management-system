<?php
// send_otp.php -- Step 2: OTP generate karke otp_verify table me save karta hai aur email bhejta hai
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $role = null;

    // Pehle student table me check karo
    $checkStudent = $conn->prepare("SELECT id FROM student WHERE email = ?");
    $checkStudent->bind_param("s", $email);
    $checkStudent->execute();
    $studentResult = $checkStudent->get_result();

    if ($studentResult->num_rows > 0) {
        $role = "student";
    } else {
        // Student me nahi mila to admin table me check karo
        $checkAdmin = $conn->prepare("SELECT id FROM admin WHERE email = ?");
        $checkAdmin->bind_param("s", $email);
        $checkAdmin->execute();
        $adminResult = $checkAdmin->get_result();

        if ($adminResult->num_rows > 0) {
            $role = "admin";
        }
    }

    if ($role === null) {
        $_SESSION['error'] = "Is email se koi account registered nahi hai.";
        header("Location: forgot_email.php");
        exit();
    }

    // Role ko session me save karo taaki password update karte waqt sahi table pata ho
    $_SESSION['reset_role'] = $role;

    // 6 digit OTP generate karo
    $otp = rand(100000, 999999);

    // OTP 10 minute ke liye valid rahega
    $created_at = date("Y-m-d H:i:s");
    $expires_at = date("Y-m-d H:i:s", strtotime('+10 minutes'));

    // Purane unused OTP is email ke liye invalid kar do (optional but recommended)
    $deleteOld = $conn->prepare("DELETE FROM otp_verify WHERE email = ?");
    $deleteOld->bind_param("s", $email);
    $deleteOld->execute();

    $stmt = $conn->prepare("INSERT INTO otp_verify (email, otp, created_at, expires_at, is_used) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $email, $otp, $created_at, $expires_at);

    if ($stmt->execute()) {

        // Email bhejna (basic PHP mail function - production me PHPMailer/SMTP use karein)
        $subject = "Your Password Reset OTP";
        $message = "Your OTP for password reset is: $otp\nThis OTP is valid for 10 minutes.";
        $headers = "From: no-reply@yourwebsite.com";

        mail($email, $subject, $message, $headers);

        // Email ko session me store karo taaki agle steps me use ho sake
        $_SESSION['reset_email'] = $email;

        header("Location: verify_otp.php");
        exit();

    } else {
        $_SESSION['error'] = "Kuch problem ho gayi, dobara try karein.";
        header("Location: forgot_email.php");
        exit();
    }
}
?>