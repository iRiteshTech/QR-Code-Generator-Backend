<?php
include 'db.php';

$sql = "DELETE FROM qr_history";

if ($conn->query($sql) === TRUE) {
    echo "History Cleared";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>