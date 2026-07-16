<?php
// update_password.php -- Step 6: users table me new password update karta hai
session_start();
include 'db.php';

if (!isset($_SESSION['otp_verified']) || !isset($_SESSION['reset_email']) || !isset($_SESSION['reset_role'])) {
    header("Location: forgot_email.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_SESSION['reset_email'];
    $role = $_SESSION['reset_role']; // "student" ya "admin"
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "Password match nahi ho raha.";
        header("Location: reset_password.php");
        exit();
    }

    // Password hash karke store karna sahi tareeka hai
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Role ke hisaab se sahi table select karo
    $tableName = ($role === "admin") ? "admin" : "student";

    $stmt = $conn->prepare("UPDATE $tableName SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);

    if ($stmt->execute()) {

        // Reset ho gaya, is email ke saare OTP records delete kar do
        $cleanup = $conn->prepare("DELETE FROM otp_verify WHERE email = ?");
        $cleanup->bind_param("s", $email);
        $cleanup->execute();

        // Session clear karo
        unset($_SESSION['reset_email']);
        unset($_SESSION['otp_verified']);
        unset($_SESSION['reset_role']);

        // Update hote hi seedha login.html par bhej do
header("Location: ../login.html");
        exit();

    } else {
        $_SESSION['error'] = "Kuch problem ho gayi, dobara try karein.";
        header("Location: reset_password.php");
        exit();
    }
}
?>