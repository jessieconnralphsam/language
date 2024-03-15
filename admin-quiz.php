<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php"); 
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "lang";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$query = "SELECT * FROM video_tutorial";
$result = $connection->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Language</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #e8f3e2;">

    <!-- Add New Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Tutorial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your form for adding new tutorial goes here -->
                    <form action="includes/add.php" method="post">
                        <!-- Form fields -->
                        <div class="form-group">
                            <label for="tutorialName">Tutorial Name</label>
                            <input type="text" class="form-control" id="tutorialName" name="tutorialName" required>
                        </div>
                        <div class="form-group">
                            <label for="embedKey">Embed Key</label>
                            <input type="text" class="form-control" id="embedKey" name="embedKey" required>
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-1">
            <div class="col col-md-8">
                <h1>Manage Quiz</h1>
            </div>
            <div class="col-3 col-md-2">
                <button class="btn btn-secondary" onclick="redirectToPage()" name="logout">Back</button>
            </div>
            <div class="col-3 col-md-1">
                <form method="post" action="">
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>
            </div>
        </div>
        <div class="container mt-5">
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>Key</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['tutorial_name']."</td>";
                            echo "<td>".$row['embed_key']."</td>";
                            echo "<td>";
                            echo '<button class="btn btn-primary mb-3">Edit</button> ';
                            echo '<button class="btn btn-danger mb-3">Delete</button>';                        
                            echo "</td>";
                            echo "</tr>";
                        }

                    } else {
                        echo "<tr><td colspan='3'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function redirectToPage() {
    window.location.href = 'manage.php';
    }
    </script>
</body>
</html>

<?php
$connection->close();
?>
