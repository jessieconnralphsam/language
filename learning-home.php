<html lang="en">
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
                                                <h6 class="mt-3">Quiz</h6>
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
    </div>
    <script>
    var container = document.getElementById("container-home");
    container.addEventListener("click", function() {
        window.location.href = "quiz.php";
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