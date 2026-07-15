<?php

include "../php/db.php";
include "session.php";

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = (int) $_GET['id'];

// Pehle image ka naam nikalo
$stmt = $conn->prepare("SELECT Image FROM student WHERE Id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();
    $image = $row['Image'];

    // Database se record delete
    $delete = $conn->prepare("DELETE FROM student WHERE Id = ?");
    $delete->bind_param("i", $id);

    if ($delete->execute()) {

        // Uploads folder se image delete
        if (!empty($image) && file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }

        header("Location: students.php");
        exit();

    } else {

        echo "Delete Failed";

    }

} else {

    echo "Student Not Found";

}

$stmt->close();
$conn->close();

?>