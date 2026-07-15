<?php

include "../php/db.php";
include "session.php";

$stmt = $conn->prepare("SELECT * FROM student");
$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>

    <link rel="stylesheet" href="../css/admin-student.css">
</head>

<body>

    <div class="student-record">
        <b class="bold-text">STUDENT RECORD!</b>
    </div>
    
    <div class="back-to-das"  >
                <a href="dashboard.php" class="back" > BACK </a>

    </div>

    <table class="student-table">

        <thead>
            <tr>
                <th>Image</th>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Course</th>
                <th>City</th>
                <th>Duration</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($row = $result->fetch_assoc()) { ?>

                <tr>

                    <td>
                        <img src="../uploads/<?php echo $row['Image']; ?>" class="student-img" alt="Student">
                    </td>

                    <td><?php echo $row['Id']; ?></td>

                    <td><?php echo $row['Name']; ?></td>

                    <td><?php echo $row['Email']; ?></td>

                    <td><?php echo $row['Mobile']; ?></td>

                    <td><?php echo $row['Course']; ?></td>

                    <td><?php echo $row['City']; ?></td>

                    <td><?php echo $row['Duration']; ?></td>

                    <td>
                        <a href="update.php?id=<?php echo $row['Id']; ?>" class="update-btn">
                            Update
                        </a>

                        <a href="delete.php?id=<?php echo $row['Id']; ?>"
                           class="delete-btn"
                           onclick="return confirm('Are you sure you want to delete this student?');">
                            Delete
                        </a>
                    </td>

                </tr>

            <?php } ?>

        </tbody>

    </table>

</body>

</html>