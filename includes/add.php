<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if all required fields are filled
    if (isset($_POST['tutorialName']) && isset($_POST['embedKey'])) {
        
        // Retrieve form data
        $tutorialName = $_POST['tutorialName'];
        $embedKey = $_POST['embedKey'];
        
        // You can perform further validation or sanitization here
        
        // Example: Save data to database
        // Replace these lines with your actual database connection and query
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lang";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO video_tutorial (tutorial_name, embed_key) VALUES (?, ?)");
        $stmt->bind_param("ss", $tutorialName, $embedKey);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Close statement and connection
            $stmt->close();
            $conn->close();
            // Redirect to a page upon successful insertion
            header("Location: ../manage.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement and connection
        $stmt->close();
        $conn->close();
        
    } else {
        echo "All fields are required!";
    }
    
} else {
    // Redirect user if accessed directly without submitting the form
    header("Location: ../index.php");
    exit();
}
