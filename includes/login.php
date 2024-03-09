<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "lang";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve user data
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // User found, set session variables and redirect to another page
        $_SESSION['username'] = $username;
        header("Location: ../manage.php"); // Change to your desired page
        exit();
    } else {
        // Incorrect username or password
        echo "Invalid username or password.";
    }
}

mysqli_close($conn);
?>
