<?php
if(isset($_GET['videoID']) && !empty($_GET['videoID'])) {
    $videoID = filter_var($_GET['videoID'], FILTER_SANITIZE_NUMBER_INT);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "lang";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $query = "DELETE FROM video_tutorial WHERE videoID = ?";

    if($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $videoID);
        if($stmt->execute()) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error: Unable to delete the tutorial.";
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
