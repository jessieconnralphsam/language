<?php
session_start();

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
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $username;
        
        if ($row['roleID'] == 1) {
            header("Location: ../manage.php");
            exit();
        } elseif ($row['roleID'] == 2) {
            header("Location: ../learning-home.php");
            exit();
        } else {
            header("Location: ../index.php");
            exit();
        }
    } else {
        header("Location: ../index.php?invalid=true"); 
        exit();
    }
}

mysqli_close($conn);
?>
