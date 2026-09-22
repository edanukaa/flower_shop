<?php
// connect.php
// Error reporting should be at the top of EVERY PHP file.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL root password
$dbname = "flowershop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if (isset($_POST['signUp'])) {
    // Retrieve form data
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Perform your registration logic here (e.g., validation, database insertion)
    // ...

    // After successful registration (or even if there's an error and you want to go back)
    header("Location: /flower_shop/index.php");
    exit(); // Make sure to exit after the header to prevent further code execution
}
?>

