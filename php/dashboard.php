<?php

include "session.php";
include "db.php";


$id = $_SESSION['id'];

$sql = "SELECT * FROM student WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>User Login</title>
</head>

<body>
<div class="main-parent" >     
   
    <div class="parent-class">

        <div class="std-profile">
<div class="btm" >
    <a href="session_end.php" class="logout-btn"  >Logout</a>

    </div>

            <h3 class="student-college">
                Dr. A. P. J. Abdul Kalam University, Indore
            </h3>
            <div class="image-detail">

                <div class="student-details">

                    <div class="detail-row">
                        <span class="label">ID</span>
                        <span class="colon">:</span>
                        <span class="value"><?php echo $row['Id']; ?></span>
                    </div>

                    <div class="detail-row">
                        <span class="label">Name</span>
                        <span class="colon">:</span>
                        <span class="value"><?php echo $row['Name']; ?></span>
                    </div>

                    <div class="detail-row">
                        <span class="label">Email</span>
                        <span class="colon">:</span>
                        <span class="value"><?php echo $row['Email']; ?></span>
                    </div>

                    <div class="detail-row">
                        <span class="label">Mobile</span>
                        <span class="colon">:</span>
                        <span class="value"><?php echo $row['Mobile']; ?></span>
                    </div>

                    <div class="detail-row">
                        <span class="label">Course</span>
                        <span class="colon">:</span>
                        <span class="value"><?php echo $row['Course']; ?></span>
                    </div>

                    <div class="detail-row">
                        <span class="label">City</span>
                        <span class="colon">:</span>
                        <span class="value"><?php echo $row['City']; ?></span>
                    </div>

                    <div class="detail-row">
                        <span class="label">Duration</span>
                        <span class="colon">:</span>
                        <span class="value"><?php echo $row['Duration']; ?></span>
                    </div>

                </div>

                <div class="profile-image">
                    <img src="../uploads/<?php echo $row['Image']; ?>" class="student-img">
                </div>

            </div>

        </div>
    
        

    </div>
</div>

</body>

</html>