<?php
session_start();

// Include database connection
include "db_conn.php";

// Verify login status
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit();
}

// Select and display images from the database
$sql = "SELECT * FROM images ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
<link rel="stylesheet" href="admin.css">
</head>
<body>
<h1>Admin Panel</h1>

<?php
// Display table header with checkboxes for bulk selection
echo "<h2>Image Gallery</h2>";
echo "<table>";
echo "<tr>
    <th></th> <th>Image</th>
    <th>Action</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td><input type='checkbox' name='image_ids[]' value='" . $row['id'] . "'></td>";
  echo "<td><img src='uploads/" . $row['image_url'] . "' width='150'></td>";
  echo "<td><a href='delete_image.php?id=" . $row['id'] . "'>Delete</a></td>";
  echo "</tr>";
}
echo "</table>";


?>

<div class="button-container">
<a href="logout.php" class="logout-button">Logout</a>
<a href="index.php" class="index-button">Home</a>
</div>

<script src="logout_timer.js"></script>

</body>
</html>

<?php
}
?>
