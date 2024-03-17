<html lang="en">
<?php include 'includes/header.php'; ?>
<?php
    session_start(); 
    
    if (isset($_SESSION['username']) && isset($_SESSION['roleID'])) {

        if ($_SESSION['roleID'] == 1) {
            header("Location: manage.php");
            exit();
        } elseif ($_SESSION['roleID'] == 2) {
            header("Location: learning-home.php");
            exit();
        } else {

            header("Location: login.php");
            exit();
        }
    }
    if (isset($_POST['logout'])) {
    
        session_destroy();

        header("Location: home.php");
        exit();
    }
?>
<body style="background-color: #e8f3e2;">
    <div class="container">
        <div class="row mt-2">
            <div class="col mt-2">
                <div class="container  d-flex justify-content-center align-items-center hover" id="container-home">
                    <img class="margin-intro-image mt-1 mx-1" src="assets/img/woman.png" alt="Description of the image" width="50">
                    <h6>Welcome, <?php echo $_SESSION['username']; ?></h6>
                </div>
            </div>
            <div class="col">

            </div>
            <div class="col">
                <form method="post" action="">
                            <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>
            </div>
            <h1 class="text-center">Hello!</h1>
            <p class="text-center">Learners </p>  
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-1 col-md-4"></div>
                <div class="col-8 col-md-8">
                    <div class="row">
                        <div class="col-12 col-md-12 mt-4">
                            <div class="col col-md-6 mx-1 border border-success p-2 rounded-4" style="--bs-border-opacity: .5;">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-9 col-md-10 mx-1 hover">
                                            <div class="container hover" id="container-home-two">
                                                <h6 class="mt-3">Video Tutorial</h6>
                                            </div>
                                        </div>
                                        <div class="col-1 col-md-1 mt-2 ">
                                            <img src="assets/img/video-player.png" alt="Description of the image" width="40">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col  col-md-12 mt-3">
                            <div class="col col-md-6 mx-1 border border-success p-2 rounded-4" style="--bs-border-opacity: .5;">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-9 col-md-10 mx-1">
                                            <div class="container hover" id="container-home-one">
                                                <h6 class="mt-3">Quiz</h6>
                                            </div>
                                        </div>
                                        <div class="col-1 col-md-1 mt-2 ">
                                            <img src="assets/img/brain.png" alt="Description of the image" width="40">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var container = document.getElementById("container-home");
    container.addEventListener("click", function() {
        window.location.href = "profile.php";
    });
    var container = document.getElementById("container-home-one");
    container.addEventListener("click", function() {
        window.location.href = "quiz.php";
    });
    var container_two = document.getElementById("container-home-two");
    container_two.addEventListener("click", function() {
        window.location.href = "learning.php";
    });
    </script>

</body>
</html>