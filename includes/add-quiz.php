<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "lang";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$quiz = $_POST['quiz'];
$quiz_link = $_POST['quiz_link'];
$monitor_link = $_POST['monitor'];

$sql = "INSERT INTO quiz (quiz, quiz_link, monitor_link) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $quiz, $quiz_link, $monitor_link);

if ($stmt->execute()) {
    header("Location: ../admin-quiz.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
