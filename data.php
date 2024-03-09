<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "lang";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$tutorial_name = $_GET['tutorial_name'];
$sql = "SELECT embed_key FROM video_tutorial WHERE tutorial_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tutorial_name);
$stmt->execute();
$stmt->bind_result($embed_key);
$stmt->fetch();
echo $embed_key;
$stmt->close();
$conn->close();
?>