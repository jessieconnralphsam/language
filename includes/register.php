<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "lang";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $roleID = mysqli_real_escape_string($conn, $_POST['role']);


    $sql = "INSERT INTO user (roleID, name, username, password) VALUES ('$roleID','$name', '$username', '$password')";
    
    if(mysqli_query($conn, $sql)){

        header("Location: ../index.php?register=success");
        exit(); 
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>
