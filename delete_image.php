<?php
session_start();

// Include database connection
include "db_conn.php";

// Verify login status
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Get image ID from URL parameter
if (isset($_GET['id'])) {
    $image_id = $_GET['id'];

    // Retrieve image URL from database
    $sql = "SELECT image_url FROM images WHERE id = $image_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image_url = $row['image_url'];

        // Delete image from database
        $sql = "DELETE FROM images WHERE id = $image_id";
        if (mysqli_query($conn, $sql)) {
            // Delete image file from server
            unlink("uploads/" . $image_url);  // Assuming images are stored in an "uploads" folder
            header("Location: admin.php?deleted=true");
            exit();
        } else {
            echo "Error deleting image from database: " . mysqli_error($conn);
        }
    } else {
        echo "Image not found.";
    }
} else {
    echo "Image ID not provided.";
}
?>
