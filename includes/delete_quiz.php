<?php
if(isset($_GET['quizID']) && !empty($_GET['quizID'])) {
    $quizzID = filter_var($_GET['quizID'], FILTER_SANITIZE_NUMBER_INT);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "lang";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $query = "DELETE FROM quiz WHERE quizID = ?";

    if($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $quizzID);
        if($stmt->execute()) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error: Unable to delete the quiz assigned to students";
        }
        $stmt->close();
    } else {
        echo "Error: Unable to prepare the delete statement.";
    }

    $connection->close();
} else {
    echo "Error: Video ID not provided.";
}
?>
