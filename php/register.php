<?php

include "db.php";

// =============================
// Check Request Method
// =============================
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Invalid Request");
}

// =============================
// Get Form Data
// =============================
$name     = trim($_POST["name"]);
$email    = trim($_POST["email"]);
$mobile   = trim($_POST["mobile"]);
$course   = trim($_POST["course"]);
$password = trim($_POST["password"]);

// =============================
// Server Side Validation
// =============================
if (
    empty($name) ||
    empty($email) ||
    empty($mobile) ||
    empty($course) ||
    empty($password)
) {
    exit("All fields are required.");
}

// =============================
// Check Duplicate Email
// =============================
$check = $conn->prepare("SELECT id FROM student WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {
    exit("Email already exists.");
}

// =============================
// Password Hashing
// =============================
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// =============================
// Image Upload
// =============================
$imageName = "";

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

    $uploadDir = "../uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

    $allowed = ["jpg", "jpeg", "png"];

    if (!in_array($extension, $allowed)) {
        exit("Only JPG, JPEG and PNG images are allowed.");
    }

    $imageName = time() . "_" . uniqid() . "." . $extension;

    move_uploaded_file(
        $_FILES["image"]["tmp_name"],
        $uploadDir . $imageName
    );
}

// =============================
// Insert Data
// =============================
$stmt = $conn->prepare("
INSERT INTO student
(name, email, mobile, course, password, image)
VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssss",
    $name,
    $email,
    $mobile,
    $course,
    $hashedPassword,
    $imageName
);

// =============================
// Execute
// =============================
if ($stmt->execute()) {
    echo "success";
} else {
    echo "Registration Failed.";
}

$stmt->close();
$check->close();
$conn->close();

?>  