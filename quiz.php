<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT quiz.quiz, quiz.quiz_link, assigned_quiz.cdate
        FROM user 
        INNER JOIN assigned_quiz ON user.id = assigned_quiz.id 
        INNER JOIN quiz ON assigned_quiz.quizID = quiz.quizID 
        WHERE user.id = $user_id";

$result = $conn->query($sql);
?>
<head>
    <title>Assigned Quizzes</title>
</head>

<body style="background-color: #e8f3e2;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container hover" id="container-home-three">
                    <div class="container" id="container-home">
                        <img src="assets/img/previous.png" alt="Description of the image" width="50">
                    </div>
                </div>
            </div>
            <div class="col">
                <h3><img class="margin-intro-image" src="assets/img/right.png" alt="Description of the image" width="20"> 
                    Integrity is doing the right thing, even when no one is watching.
                    <img class="margin-intro-image" src="assets/img/left.png" alt="Description of the image" width="20">
                </h3>
                <h6 style="color: #f0bf53;">- C.S. Lewis</h6>
            </div>
            <div class="col">
                <img class="margin-intro-image" src="assets/img/food-truck.png" alt="Description of the image" width="200">
            </div>
            <div class="container">
                <img class="d-block mx-auto" src="assets/img/arrow-2.png" alt="Description of the image" width="250">
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center">
        <h5>Assigned Quiz</h5>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Quiz</th>
                        <th>Quiz Link</th>
                        <th>Date Assigned</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["quiz"] . "</td>";
                            echo "<td><a href='" . $row["quiz_link"] . "'>" . (strlen($row["quiz_link"]) > 10 ? substr($row["quiz_link"], 0, 10) . '...' : $row["quiz_link"]) . "</a></td>";
                            echo "<td>" . $row["cdate"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No assigned quizzes found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var container_three = document.getElementById("container-home");
        container_three.addEventListener("click", function () {
            window.location.href = "learning-home.php";
        });
    </script>
</body>

</html>
