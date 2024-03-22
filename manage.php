<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php"); 
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
                <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            </div>
            <!-- <div class="col-3 col-md-2 border d-flex justify-content-end align-items-center">
                <button type="button" onclick="redirectToPage()" class="btn btn-success mt-0">Quiz</button>
            </div> -->
            <div class="col-3 col-md-1">
                <form method="post" action="">
                    <button class="btn btn-primary mt-2" type="submit" name="logout">Logout</button>
                </form>  
            </div>
        </div>
        <div class="container mt-5">
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Add New</button>
            <button type="button" onclick="redirectToPage()" class="btn btn-primary mb-3">Quiz</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Key</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Tutorial</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="includes/edit.php" method="post">
                                        <input type="hidden" id="editTutorialId" name="tutorialId">
                                        <div class="form-group">
                                            <label for="editTutorialName">Tutorial Name</label>
                                            <input type="text" class="form-control" id="editTutorialName" name="tutorialName" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editEmbedKey">Embed Key</label>
                                            <input type="text" class="form-control" id="editEmbedKey" name="embedKey" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    function populateEditModal(tutorialId, tutorialName, embedKey) {
                        $('#editTutorialId').val(tutorialId);
                        $('#editTutorialName').val(tutorialName);
                        $('#editEmbedKey').val(embedKey);
                        $('#editModal').modal('show');
                    }
                    </script>
                    <script>
                    function confirmDelete(videoID) {
                        if (confirm("Are you sure you want to delete this video tutorial?")) {
                            window.location.href = 'includes/delete.php?videoID=' + videoID;
                        }
                    }
                    </script>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['tutorial_name']."</td>";
                            echo "<td>".$row['embed_key']."</td>";
                            echo "<td>";
                            echo '<button class="btn btn-primary mb-3" onclick="populateEditModal('.$row['videoID'].', \''.$row['tutorial_name'].'\', \''.$row['embed_key'].'\')">Edit</button> ';
                            echo '<button class="btn btn-danger mb-3" onclick="confirmDelete('.$row['videoID'].')">Delete</button>';                       
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
    window.location.href = 'admin-quiz.php';
    }
    </script>
</body>
</html>

<?php
$connection->close();
?>
