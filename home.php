<html lang="en">
<?php include 'includes/header.php'; ?>
<body style="background-color: #e8f3e2;">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container hover" id="container-home-three">
                    <img class="margin-intro-image mt-1 mx-1" src="assets/img/leader.png" alt="Description of the image" width="50">
                </div>
            </div>
            <div class="col">
                <h3><img class="margin-intro-image" src="assets/img/right.png" alt="Description of the image" width="20"> 
                Silence holds strength within
                <img class="margin-intro-image" src="assets/img/left.png" alt="Description of the image" width="20">
                </h3>
                <h6 style="color: #f0bf53;">- Theodore Deafman</h6>
            </div>
            <div class="col">
                <img class="margin-intro-image" src="assets/img/food-truck.png" alt="Description of the image" width="200">
            </div>
            <div class="container">
                <img class="d-block mx-auto" src="assets/img/arrow-2.png" alt="Description of the image" width="250">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="margin-intro-image" src="assets/img/pat.png" alt="Description of the image" width="300">
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-12 col-md-12 mt-4">
                        <div class="col col-md-6 mx-1 border border-success p-2 rounded-4" style="--bs-border-opacity: .5;">
                            <div class="row">
                                <div class="row">
                                    <div class="col-9 col-md-10 mx-1 hover">
                                        <div class="container hover" id="container-home-two">
                                            <h5 class="mt-3">Artificial Inteligence</h5>
                                        </div>
                                    </div>
                                    <div class="col-1 col-md-1 mt-2 ">
                                        <img src="assets/img/image-processing.png" alt="Description of the image" width="40">
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
                                            <h5 class="mt-3" >Learning Material</h5>
                                        </div>
                                    </div>
                                    <div class="col-1 col-md-1 mt-2 ">
                                        <img src="assets/img/reading.png" alt="Description of the image" width="40">
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
    var container = document.getElementById("container-home-one");
    container.addEventListener("click", function() {
        window.location.href = "learning.php";
    });
    var container_two = document.getElementById("container-home-two");
    container_two.addEventListener("click", function() {
        window.location.href = "artificial.php";
    });
    var container_two = document.getElementById("container-home-two");
    container_two.addEventListener("click", function() {
        window.location.href = "artificial.php";
    });
    var container_three = document.getElementById("container-home-three");
    container_three.addEventListener("click", function() {
        window.location.href = "login.php";
    });
    </script>
</body>
</html>