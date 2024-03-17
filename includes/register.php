<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "lang";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $roleID = mysqli_real_escape_string($conn, $_POST['role']);

    // Attempt to insert the user data into the database
    $sql = "INSERT INTO user (roleID, name, username, password) VALUES ('$roleID','$name', '$username', '$password')";
    
    if(mysqli_query($conn, $sql)){
        // Redirect to login page with success message
        header("Location: ../login.php?register=success");
        exit(); // Ensure that script execution stops after redirection
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
