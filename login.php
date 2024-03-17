<html lang="en">
<?php
if(isset($_GET['invalid']) && $_GET['invalid'] == 'true'){
    echo "<script>alert('Invalid username or password. Please try again.');</script>";
}
?>
<?php

if(isset($_GET['register']) && $_GET['register'] === 'success') {

    echo "<script>alert('Registration successful!');</script>";
}
?>
<?php include 'includes/header.php'; ?>


<style>
    .container-login{
        width: 400px;
    }
</style>
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
            <h1 class="text-center">login</h1>
        </div>
    </div>
    <div class="container container-login">
    <form method="post" action="includes/login.php">
        <div class="form-group">
            <strong><label for="username">Username</label></strong>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
        </div>
        <div class="form-group mb-2">
            <strong><label for="password">Password</label></strong>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" onclick="redirectToPage()" class="btn btn-danger">Register</button>
    </form>
    </div>
    <script>
    var container = document.getElementById("container-home");
    container.addEventListener("click", function() {
        window.location.href = "home.php";
    });
    function redirectToPage() {
    window.location.href = 'register.php';
    }
    </script>
</body>
</html>