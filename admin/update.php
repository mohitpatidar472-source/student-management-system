<?php

include "../php/db.php";
include "session.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM student WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();

} else {

    die("Student not found.");

}


// =========================
// UPDATE
// =========================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id       = $_POST['id'];
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $mobile   = trim($_POST['mobile']);
    $course   = trim($_POST['course']);
    $city     = trim($_POST['city']);
    $duration = trim($_POST['duration']);

    $old_image = $_POST['old_image'];

    // Image Upload

    if ($_FILES['image']['error'] == 0) {

        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/" . $image
        );

        // Delete old image
        if (!empty($old_image) && file_exists("../uploads/" . $old_image)) {

            unlink("../uploads/" . $old_image);

        }

    } else {

        $image = $old_image;

    }


    $update = $conn->prepare("
        UPDATE student
        SET
            Image = ?,
            Name = ?,
            Email = ?,
            Mobile = ?,
            Course = ?,
            City = ?,
            Duration = ?
        WHERE Id = ?
    ");

    $update->bind_param(
        "sssssssi",
        $image,
        $name,
        $email,
        $mobile,
        $course,
        $city,
        $duration,
        $id
    );

    if ($update->execute()) {

        header("Location: students.php");
        exit();

    } else {

        echo "Update Failed";

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="../css/admin-update.css">
</head>

<body>
<!-- 
<form method="POST" enctype="multipart/form-data">

    <h2>Update Student</h2>

    <img src="../uploads/<?php echo $row['Image']; ?>" width="120" height="120">

    <br><br>

    <input type="hidden" name="old_image" value="<?php echo $row['Image']; ?>">

    <input type="file" name="image">

    <br><br>

    <label>ID</label><br>
    <input type="text" name="id" value="<?php echo $row['Id']; ?>" readonly>

    <br><br>

    <label>Name</label><br>
    <input type="text" name="name" value="<?php echo $row['Name']; ?>">

    <br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?php echo $row['Email']; ?>">

    <br><br>

    <label>Mobile</label><br>
    <input type="text" name="mobile" value="<?php echo $row['Mobile']; ?>">

    <br><br>

    <label>Course</label><br>
    <input type="text" name="course" value="<?php echo $row['Course']; ?>">

    <br><br>

    <label>City</label><br>
    <input type="text" name="city" value="<?php echo $row['City']; ?>">

    <br><br>

    <label>Duration</label><br>
    <input type="text" name="duration" value="<?php echo $row['Duration']; ?>">

    <br><br>

    <button type="submit">Update Student</button>

</form> -->

<form method="POST" enctype="multipart/form-data">

    <div class="update-form">

        <h2>UPDATE STUDENT</h2>

        <div class="update-image">
            <img src="../uploads/<?php echo $row['Image']; ?>" alt="">

            <input type="hidden" name="old_image" value="<?php echo $row['Image']; ?>">

            <input type="file" name="image">
        </div>

        <div class="input-box">
            <label>ID</label>
            <input type="text" name="id" value="<?php echo $row['Id']; ?>" readonly>
        </div>

        <div class="input-box">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $row['Name']; ?>">
        </div>

        <div class="input-box">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $row['Email']; ?>">
        </div>

        <div class="input-box">
            <label>Mobile</label>
            <input type="text" name="mobile" value="<?php echo $row['Mobile']; ?>">
        </div>

        <div class="input-box">
            <label>Course</label>
            <input type="text" name="course" value="<?php echo $row['Course']; ?>">
        </div>

        <div class="input-box">
            <label>City</label>
            <input type="text" name="city" value="<?php echo $row['City']; ?>">
        </div>

        <div class="input-box">
            <label>Duration</label>
            <input type="text" name="duration" value="<?php echo $row['Duration']; ?>">
        </div>

        <button class="update-btn" type="submit">
            Update Student
        </button>

    </div>

</form>

</body>
</html>