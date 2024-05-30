// Set the logout timeout to 20 seconds (20000 milliseconds) 20k or 20sec
var logoutTimeout = 55000;

// Function to redirect to logout.php
function logout() {
  window.location.href = "logout.php";
}

// Start a timer to call the logout function after the timeout
setTimeout(logout, logoutTimeout);

// (Optional) Add user interaction reset (explained later)
// Set the logout timeout to 20 seconds (20000 milliseconds) 20k or 20sec
var logoutTimeout = 10000;

// Function to redirect to logout.php
function logout() {
  window.location.href = "logout.php";
}

// Start a timer to call the logout function after the timeout
setTimeout(logout, logoutTimeout);

// (Optional) Add user interaction reset (explained later)
