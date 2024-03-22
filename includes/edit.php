<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tutorialId = $_POST['tutorialId'];
    $tutorialName = $_POST['tutorialName'];
    $embedKey = $_POST['embedKey'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "lang";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $query = "UPDATE video_tutorial SET tutorial_name='$tutorialName', embed_key='$embedKey' WHERE videoID=$tutorialId";

    if ($connection->query($query) === TRUE) {
        header("Location: ../manage.php");
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
        $connection->close();
    }
} else {
    header("Location: ../manage.php");
    exit();
}
?>
