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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $_SESSION['username'] = $username;
        header("Location: ../manage.php");
        exit();
    } else {
        header("Location: ../login.php?invalid=true"); 
        exit();
    }
}

mysqli_close($conn);
?>
