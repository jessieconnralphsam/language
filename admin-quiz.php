<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php"); 
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

    $query = "SELECT * FROM quiz";
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
                    <h5 class="modal-title" id="addModalLabel">Add New Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your form for adding new tutorial goes here -->
                    <form action="includes/add-quiz.php" method="post">
                        <!-- Form fields -->
                        <div class="form-group">
                            <label for="tutorialName">Quiz Title</label>
                            <input type="text" class="form-control" id="quiz" name="quiz" required>
                        </div>
                        <div class="form-group">
                            <label for="embedKey">Monitor Link</label>
                            <input type="text" class="form-control" id="monitor" name="monitor" required>
                        </div>
                        <div class="form-group">
                            <label for="embedKey">Quiz Link</label>
                            <input type="text" class="form-control" id="quiz_link" name="quiz_link" required>
                        </div>
                        <!-- Add more form fields as needed -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-2">
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
            <button class="btn btn-primary mb-3" onclick="redirectToAssign()">Assign</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>Quiz Title</th>
                        <th>Quiz Link</th>
                        <th>Monitor Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Quiz Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="includes/edit_quiz.php" method="post">
                                        <input type="hidden" id="editquizId" name="editquizId">
                                        <div class="form-group">
                                            <label for="editquizName">Quiz Name:</label>
                                            <input type="text" class="form-control" id="editquizName" name="editquizName" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editquizlink">Quiz Link:</label>
                                            <input type="text" class="form-control" id="editquizlink" name="editquizlink" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editmonitorlink">Monitor Link:</label>
                                            <input type="text" class="form-control" id="editmonitorlink" name="editmonitorlink" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <tbody>
                    <script>
                    function populateEditModal(quiz_id, quiz_name, quiz_link, monitor_link) {
                        $('#editquizId').val(quiz_id);
                        $('#editquizName').val(quiz_name);
                        $('#editquizlink').val(quiz_link);
                        $('#editmonitorlink').val(monitor_link);
                        $('#editModal').modal('show');
                    }
                    </script>
                    <script>
                    function confirmDelete(quizID) {
                        if (confirm("Are you sure you want to delete this video tutorial?")) {
                            window.location.href = 'includes/delete_quiz.php?quizID=' + quizID;
                        }
                    }
                    </script>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['quiz']."</td>";
                            echo "<td>". (strlen($row['quiz_link']) > 15 ? substr($row['quiz_link'], 0, 15) . '...' : $row['quiz_link']) . "</td>";
                            echo "<td><a href='" . $row['monitor_link'] . "'>" . (strlen($row['monitor_link']) > 15 ? substr($row['monitor_link'], 0, 15) . '...' : $row['monitor_link']) . "</a></td>";
                            echo "<td>";
                            echo '<button class="btn btn-primary mb-3" onclick="populateEditModal('.$row['quizID'].', \''.$row['quiz'].'\', \''.$row['quiz_link'].'\',\''.$row['monitor_link'].'\')">Edit</button> ';
                            echo '<button class="btn btn-danger mb-3" onclick="confirmDelete('.$row['quizID'].')">Delete</button>';                        
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No data found</td></tr>";
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
    function redirectToAssign() {
    window.location.href = 'assign.php';
    }
    </script>
</body>
</html>

<?php
$connection->close();
?>
