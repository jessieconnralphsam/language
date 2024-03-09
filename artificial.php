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
        window.location.href = "home.php";
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
        // the link to your model provided by Teachable Machine export panel
        const URL = "http://localhost/sign_languange/";

        let model, webcam, labelContainer, maxPredictions;

        // Load the image model and setup the webcam
        async function init() {
            // Check if the browser supports getUserMedia
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('Your browser does not support getUserMedia API');
                return;
            }

            try {
                // Request permission to access the webcam
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });

                // Load the model and metadata
                const modelURL = URL + "model/model.json";
                const metadataURL = URL + "model/metadata.json";
                model = await tmImage.load(modelURL, metadataURL);
                maxPredictions = model.getTotalClasses();

                // Convenience function to setup a webcam
                const flip = true; // whether to flip the webcam
                webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
                await webcam.setup(stream); // Use the obtained stream
                await webcam.play();
                window.requestAnimationFrame(loop);

                // Append elements to the DOM
                document.getElementById("webcam-container").appendChild(webcam.canvas);
                labelContainer = document.getElementById("label-container");
            } catch (error) {
                console.error('Error accessing the webcam:', error);
                alert('Error accessing the webcam. Please make sure it is enabled and try again.');
            }
        }


        async function loop() {
            webcam.update(); // update the webcam frame
            await predict();
            window.requestAnimationFrame(loop);
        }

        // run the webcam image through the image model
        async function predict() {
            // predict can take in an image, video or canvas html element
            const prediction = await model.predict(webcam.canvas);
            const maxPredictionIndex = getIndexOfMaxPrediction(prediction);
            const classPrediction = prediction[maxPredictionIndex].className;
            labelContainer.innerHTML = classPrediction;
        }

        // Helper function to get the index of the class with the highest probability
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