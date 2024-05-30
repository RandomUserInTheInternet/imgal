<?php
session_start();

// Include database connection
include "db_conn.php";

// Define username and password (replace with your desired credentials)
$username = "admin";
$hashed_password = password_hash("pussy", PASSWORD_DEFAULT);

// Check if login form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    // Validate username
    if ($entered_username === $username) {
        // Verify password using password_verify()
        if (password_verify($entered_password, $hashed_password)) {
            // Login successful, set session variable
            $_SESSION['loggedin'] = true;
            header("Location: admin.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid username.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
    /* General styles */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1 {
  text-align: center; /* Center align the heading */
}
.login-container {
  margin: 20px auto; /* Center the container horizontally */
  width: 350px; /* Adjust width as needed */
  padding: 20px; /* Add padding */
  border: 1px solid #ddd; /* Add a border (optional) */
  border-radius: 5px; /* Add rounded corners (optional) */
}

/* Form styles */
form {
  margin: 20px auto; /* Center the form horizontally */
  width: 300px; /* Set form width */
  padding: 10px; /* Add padding */
  border: 1px solid #ddd; /* Add a border */
}

label {
  display: block; /* Display labels on separate lines */
  margin-bottom: 10px; /* Add space between labels and inputs */
}

input[type="text"],
input[type="password"] {
  width: 100%; /* Make input fields full width */
  padding: 10px; /* Add padding to inputs */
  border: 1px solid #ccc; /* Add a border to inputs */
}
input[type="submit"] {
  background-color: #00C853; /* Set button background color */
  margin-top: 10px;
  color: white; /* Set button text color */
  padding: 10px 20px; /* Add padding */
  border: none; /* Remove default border */
  border-radius: 5px; /* Add rounded corners */
  cursor: pointer; /* Indicate clickable behavior */
}

/* Home button styles */
.home-button {
  justify-content: center;
  margin: 17px 0; /* Margin top and bottom */
  text-decoration: none; /* Remove underline from link */
  padding: 8px; /* Add padding to button */
  background-color: red; /* Set button background color */
  color: white; /* Set button text color */
  border-radius: 5px; /* Add rounded corners */
  cursor: pointer; /* Indicate clickable behavior */
}

.home-button:hover {
  background-color: #ccc; /* Change background color on hover */
}

</style>

</head>
<body>
<h1>Admin Login</h1>

<?php
// Display error message if login failed
if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
?>

<div class="login-container">
  <form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Login">
  </form>
  <a href="index.php" class="home-button">HOME</a>
</div>

</body>
</html>
