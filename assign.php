<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quizID = $_POST['quizID'];
    $studentIDs = $_POST['students'];

    foreach ($studentIDs as $studentID) {
        $sql = "INSERT INTO assigned_quiz (id, quizID) VALUES ($studentID, $quizID)";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    echo '<script>alert("Students assigned successfully!");</script>';
}

$sql = "SELECT quizID, quiz FROM quiz";
$result = $conn->query($sql);

$sql_students = "SELECT id, username FROM user WHERE roleID = 2;";
$result_students = $conn->query($sql_students);
?>

<!DOCTYPE html>
<html>
<?php include 'includes/header.php'; ?>
<body  style="background-color: #e8f3e2;">
    <div class="container">
        <div class="row">
            <div class="col mt-2">
                <div class="container" id="container-home">
                    <img src="assets/img/previous.png" alt="Description of the image" width="50">
                </div>
            </div>
            <div class="col">

            </div>
            <div class="col">
                <img src="assets/img/arrow-2.png" alt="Description of the image" width="200">
            </div>
            <h1 class="text-center">Hello!</h1> 
            <div style="margin: 1rem;"></div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <h2>Assign Quiz to student(s)</h2><br>
    </div>
    <div class="container d-flex justify-content-center mt-4">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <strong><label for="quizID">Select Quiz:</label></strong>
            <select name="quizID" id="quizID">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['quizID']."'>".$row['quiz']."</option>";
                    }
                }
                ?>
            </select>
            <br><br>
            <strong><label for="students">Select Student(s):</label></strong>
            <?php
            if ($result_students->num_rows > 0) {
                while($row = $result_students->fetch_assoc()) {
                    echo "<input type='checkbox' name='students[]' value='".$row['id']."'>".$row['username']."<br>";
                }
            }
            ?>
            <br>
            <input type="submit" value="Assign Students">
        </form>
    </div>
    <script>
    var container = document.getElementById("container-home");
    container.addEventListener("click", function() {
        window.location.href = "learning-home.php";
    });
    </script>
</body>
</html>

<?php
$conn->close();
?>
