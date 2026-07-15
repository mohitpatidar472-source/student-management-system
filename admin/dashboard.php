<?php

include "session.php";
include "../php/db.php";
$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM student");
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin-dash.css">
</head>

<body>

  <div class="header">

    <div class="logo">
        <img src="../image/admin-logo.jpg" alt="Logo"> 
        <!-- <p class="p-tag" >Admin</p> -->
    </div>

    <div class="nav">
        <a href="../register.html">+ Add Student</a>
        <a href="students.php">Students</a>
    </div>

    <div class="logout">
        <a href="session_end.php">Logout</a>
    </div>

</div>

<div class="dashboard-card">

    <h2>Total Students</h2>

    <span><?php echo $row['total']; ?></span>

</div>

</body>

</html>