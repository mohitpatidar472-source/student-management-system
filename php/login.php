<?php
include "db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    exit("invalid request");
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($email) || empty($password)) {
    exit("All fields are required");
}



$stmt = $conn->prepare('SELECT * FROM admin WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();


$result = $stmt->get_result();

if($result->num_rows == 1){

$admin = $result->fetch_assoc();

if (password_verify($password, $admin['password'])) {

    $_SESSION['admin_login'] = true;

    $_SESSION['name'] = $admin['name'];
    $_SESSION['email'] = $admin['email'];

    echo "admin";
    exit();

} else {

    echo "Wrong password";
    exit();

}
}


/* ==========================
   Check Student Login
========================== */



$stmt = $conn->prepare("SELECT * FROM student WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();


if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();

    if (password_verify($password, $row["Password"])) {

        $_SESSION["login"] = true;

        $_SESSION["id"] = $row["Id"];
        $_SESSION["name"] = $row["Name"];
        $_SESSION["email"] = $row["Email"];
        $_SESSION["mobile"] = $row["Mobile"];
        $_SESSION["course"] = $row["Course"];
        $_SESSION['city'] = $row['City'];
        $_SESSION['duration'] = $row['Duration'];
        $_SESSION["image"] = $row["Image"];

        echo "student";

    } else {

        echo "Wrong password";

    }

} else {

    echo "Email not found";

}
$stmt->close();
$conn->close();


?>