<html lang="en">
<?php include 'includes/header.php'; ?>
<body style="background-color: #e8f3e2;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container hover" id="container-home-three">
                    <img class="margin-intro-image mt-1 mx-1" src="assets/img/woman.png" alt="Description of the image" width="50">
                    <h6>Student</h6>
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
    <script>
    var container_three = document.getElementById("container-home-three");
    container_three.addEventListener("click", function() {
        window.location.href = "profile.php";
    });
    </script>
</body>
</html>