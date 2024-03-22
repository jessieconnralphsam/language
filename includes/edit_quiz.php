<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editquizId = $_POST['editquizId'];
    $editquizName = $_POST['editquizName'];
    $editquizlink = $_POST['editquizlink'];
    $editmonitorlink = $_POST['editmonitorlink'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "lang";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $query = "UPDATE quiz SET quiz='$editquizName', quiz_link='$editquizlink', monitor_link='$editmonitorlink' WHERE quizID=$editquizId";

    if ($connection->query($query) === TRUE) {
        header("Location: ../admin-quiz.php");
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
        $connection->close();
    }
} else {
    header("Location: ../admin-quiz.php");
    exit();
}
?>
