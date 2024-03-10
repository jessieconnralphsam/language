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
            <p class="text-center">Search word below</p>  
        </div>
    </div>
    <!-- <div class="container">
            <div class="border border-success p-2 rounded-4 d-flex justify-content-center" style="--bs-border-opacity: .5;">
                <div class="row">
                    <div class="row">
                        <div class="col-1 col-md-2"></div>
                        <div class="col-9 col-md-10 mt-3">
                            <input id="searchInput" type="text" class="form-control border-0 bg-transparent">
                        </div>
                        <div class="col-2 col-md-1">
                            <img id="searchImage" src="assets/img/search.png" alt="Description of the image" width="50">
                        </div>
                    </div>
                </div>
            </div>
    </div> -->
    <div class="container border border-success p-2 rounded-4 d-flex justify-content-center" style="--bs-border-opacity: .5; width: 300px;">
        <input id="searchInput" type="text" class="form-control border-0 bg-transparent">
        <img id="searchImage" src="assets/img/search.png" alt="Description of the image" width="40">
    </div>
    <div class="container" style="text-align: center;">
        <div class="container"><h1>Result</h1></div>
        <iframe id="tutorialVideo" width="300" height="200" src="" frameborder="0" allowfullscreen></iframe>
    </div>
    <h1 class="text-center mt-2" id="result" style="color: #f0bf53;"></h1>
    <!-- <div class="container">
        <div class="row">
            <div class="col col-md-1">

            </div>
            <div class="col col-md-6 mx-1" style="--bs-border-opacity: .5;">
                <div class="row">
                    <div class="row">
                        <div class="col-9 col-md-10 mx-1 border">
                            <div style="margin: 1rem;"></div>
                            <h3 class="text-center" id="result" style="color: #f0bf53;"></h3>
                        </div>
                        <div class="col-1 col-md-1 mt-2 ">
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-md-1">
            </div>
            <div style="margin: 2rem;"></div>
        </div>
    </div> -->
    <script>
    var container = document.getElementById("container-home");
    container.addEventListener("click", function() {
        window.location.href = "home.php";
    });
    </script>
    <script>
        const input = document.getElementById('searchInput');
        const image = document.getElementById('searchImage');
        const result = document.getElementById('result');
        const iframe = document.getElementById('tutorialVideo');

        image.addEventListener('click', function() {
            const inputValue = input.value;
            const tutorialName = inputValue.toLowerCase();

            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'data.php?tutorial_name=' + tutorialName, true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    const embedKey = xhr.responseText;
                    console.log(embedKey);
                    result.textContent = tutorialName;
                    iframe.src = "https://www.youtube.com/embed/" + embedKey;
                } else {
                    console.error('Request failed with status:', xhr.status);
                }
            };
            xhr.send();
        });
    </script>

</body>
</html>