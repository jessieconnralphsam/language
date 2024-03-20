<?php
    session_start(); 
    if (!isset($_SESSION['username'])) {
        header("Location: index.php"); 
        exit();
    }
?>
<html lang="en">
<?php include 'includes/header.php'; ?>
<style>
    #label-container {
        color: #f0bf53; 
        font-size: 80px;
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
            <h1 class="text-center">Hello!</h1>
            <p class="text-center">Please press start to open camera</p>  
            <div class="container d-flex justify-content-center">
                <button type="button" class="btn btn-sm btn-primary" onclick="init()">Start</button>
            </div>
            <div style="margin: 1rem;"></div>
        </div>
    </div>
    <div class="container" id="webcam-container" style="text-align: center;"></div>
    <div style="margin: 1rem;"></div>
    <div class="container d-flex justify-content-center">
        <div id="label-container"></div>
    </div>
    <div style="margin: 2rem;"></div>
    <script>
    var container = document.getElementById("container-home");
    container.addEventListener("click", function() {
        window.location.href = "learning-home.php";
    });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const videoContainer = document.getElementById('videoContainer');
            const videoElement = document.createElement('video');
            videoElement.setAttribute('width', '300');
            videoElement.setAttribute('height', '200');
            videoElement.setAttribute('autoplay', true);
            videoElement.setAttribute('controls', true);
            videoContainer.innerHTML = ''; 
            videoContainer.appendChild(videoElement);

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    videoElement.srcObject = stream;
                })
                .catch(function (error) {
                    console.error('Error accessing camera:', error);
                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
    <script type="text/javascript">

        const URL = "http://localhost/language/";

        let model, webcam, labelContainer, maxPredictions;


        async function init() {

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('Your browser does not support getUserMedia API');
                return;
            }

            try {

                const stream = await navigator.mediaDevices.getUserMedia({ video: true });


                const modelURL = URL + "model/model.json";
                const metadataURL = URL + "model/metadata.json";
                model = await tmImage.load(modelURL, metadataURL);
                maxPredictions = model.getTotalClasses();

                const flip = true; 
                webcam = new tmImage.Webcam(200, 200, flip); 
                await webcam.setup(stream); 
                await webcam.play();
                window.requestAnimationFrame(loop);


                document.getElementById("webcam-container").appendChild(webcam.canvas);
                labelContainer = document.getElementById("label-container");
            } catch (error) {
                console.error('Error accessing the webcam:', error);
                alert('Error accessing the webcam. Please make sure it is enabled and try again.');
            }
        }


        async function loop() {
            webcam.update(); 
            await predict();
            window.requestAnimationFrame(loop);
        }


        async function predict() {

            const prediction = await model.predict(webcam.canvas);
            const maxPredictionIndex = getIndexOfMaxPrediction(prediction);
            const classPrediction = prediction[maxPredictionIndex].className;
            labelContainer.innerHTML = classPrediction;
        }


        function getIndexOfMaxPrediction(predictions) {
            let maxIndex = 0;
            let maxProbability = predictions[0].probability;
            for (let i = 1; i < predictions.length; i++) {
                if (predictions[i].probability > maxProbability) {
                    maxIndex = i;
                    maxProbability = predictions[i].probability;
                }
            }
            return maxIndex;
        }
    </script>
</body>
</html>