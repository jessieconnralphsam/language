<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    if (isset($_POST['tutorialName']) && isset($_POST['embedKey'])) {
        

        $tutorialName = $_POST['tutorialName'];
        $embedKey = $_POST['embedKey'];
        

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lang";

        $conn = new mysqli($servername, $username, $password, $dbname);
        

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        

        $stmt = $conn->prepare("INSERT INTO video_tutorial (tutorial_name, embed_key) VALUES (?, ?)");
        $stmt->bind_param("ss", $tutorialName, $embedKey);
        

        if ($stmt->execute()) {
            
            $stmt->close();
            $conn->close();

            header("Location: ../manage.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        

        $stmt->close();
        $conn->close();
        
    } else {
        echo "All fields are required!";
    }
    
} else {

    header("Location: ../index.php");
    exit();
}
