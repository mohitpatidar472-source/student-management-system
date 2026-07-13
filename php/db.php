

<?php



$host = "localhost";
$user = "root";   // default user
$pass = "";       // default password
$dbname = "studentmanagement";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>