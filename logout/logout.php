<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page after logout
header("Location: /homepage/html/index.html"); // Replace with the actual path

// Make sure that the code below does not get executed when we redirect.
exit();
?>
