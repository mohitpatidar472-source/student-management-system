<?php
include  "db.php";
session_start();

if($_SERVER['REQUEST_METHOD'] != "POST"){
    exit("invalid request");
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($email) || empty($password)) {
    exit("All fields are required");
}

$stmt = $conn->prepare("SELECT * FROM student WHERE email = ?");
$stmt->bind_param("s",$email);
$stmt-> ();

$result = $stmt->get_result();


if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();


    if (password_verify($password, $row["password"])) {

       $_SESSION["id"] = $row["Id"];
$_SESSION["name"] = $row["Name"];
$_SESSION["email"] = $row["Email"];

        echo "success";

    } else {

        echo "Wrong password";
    }

} else {

    echo "Email not found";
}   

$stmt->close();
$conn->close();


?>