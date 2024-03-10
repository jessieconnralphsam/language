<html lang="en">
<?php
if(isset($_GET['invalid']) && $_GET['invalid'] == 'true'){
    echo "<script>alert('Invalid username or password. Please try again.');</script>";
}
?>
<?php include 'includes/header.php'; ?>
<body style="background-color: #e8f3e2;">
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
            <h5 class="text-center">admin login!!</h5>
            <p class="text-center">Manage Video Learning Material</p>  
        </div>
    </div>
    <div class="container">
    <form method="post" action="includes/login.php">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
        </div>
        <div class="form-group mb-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <script>
    var container = document.getElementById("container-home");
    container.addEventListener("click", function() {
        window.location.href = "home.php";
    });
    </script>
</body>
</html>