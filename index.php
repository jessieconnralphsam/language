<html lang="en">
<?php include 'includes/header.php'; ?>
<body style="background-color: #e8f3e2;">
    <div class="container">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col">

            </div>
            <div class="col">
                <img src="assets/img/arrow-2.png" alt="Description of the image" width="200">
            </div>
            <h1 class="text-center">Hello!</h1>
            <p class="text-center">Welcome to our system, <br> where every gesture speaks volumes</p>
        </div>
    </div>
    <div class="container">
        <?php include 'assets/svg/wheel.php'; ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                <img class="margin-intro-image" src="assets/img/arrow-1.png" alt="Description of the image" width="150">
                <div class="container container-letsgo"  id="container-intro">
                    <div class="container" id="container-intro">
                        <h3 class="text-center">Let's go!</h3>
                    </div>
                </div>
            </div>
            <div class="col col-md-8">
                
            </div>
            <div class="col col-md-2">

            </div>
        <div style="margin: 2rem;"></div>
        <div style="margin: 2rem;"></div>
        </div>
    </div>

    <script>
    var container = document.getElementById("container-intro");
    container.addEventListener("click", function() {
        window.location.href = "home.php";
    });
    </script>
</body>
</html>