<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .homebtn {
            padding: 10px;
            background-color: white !important;
            color: #4169E1;
            border-radius: 5px;
            text-decoration: none;
        }

        .homebtn:hover {
            background-color: #4169E1 !important;
            border: 1px solid white !important;
            color: white !important;
            text-decoration: none;
        }

        .head {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #4169E1 !important;
        }

        body {
            padding-top: 40px;
        }

        .titleh {
            color: white;
        }

        #webcam-container {
            margin-top: 20px;
            width: 100%;
            height: fit-content;
            display: flex;
            justify-content: center;
            overflow-x: hidden;
            /* Ensure the webcam feed doesn't overflow its container */
            position: relative;
            /* Required for absolute positioning of the flip camera button */
        }

        #webcam-container video {
            width: 100%;
            /* Ensure the video fills the container width */
            height: auto;
            /* Maintain aspect ratio */
        }

        #label-container {
            margin-top: 20px;
            text-align: center;
        }

        /* Animation for modal */
        @keyframes slideFromBottom {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .modal-from-bottom {
            position: fixed;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 1060;
            overflow-y: auto;
            animation: slideFromBottom 0.5s ease forwards;
        }

        /* Style for camera flip button */
        #flip-camera-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px;
            cursor: pointer;
        }

        #flip-camera-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        div:has(.capture-btn-group) {
            position: relative;
        }

        .capture-btn-group {
            position: absolute;
            left: 50%;
            bottom: 10%;

        }

        #capture-button {

            padding: clamp(1.5rem, 0.5rem + 0.5vh + 0.5vw, 4rem);
            background-color: color-mix(in srgb, #4169e1 75%, transparent);
            border-radius: 50%;
            border: transparent solid clamp(1px, 0.25rem + 0.1vh + 0.1vw, 1rem);
            outline: white solid clamp(2px, 0.01rem + 0.3vh + 0.1vw, 5px);
            transform: translateX(-40%);

        }

        #capture-button:hover {

            background-color: color-mix(in srgb, #4169e1 95%, transparent);
            filter: brightness(120%);

        }

        canvas {
            overflow-clip-margin: unset;
            overflow: unset;
        }
    </style>
</head>

<body>
<nav class="head navbar navbar-expand-lg navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <h1 style="color: white; font-family: Josefin Sans; margin-top: 15px; font-size: 25px;"><b>ARTLENS</b></h1>
        <a class="homebtn" href="index.php">Home</a>
    </div>
</nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <div id="webcam-container">
                    <button id="flip-camera-btn" class="btn btn-sm"><i class="fas fa-sync-alt"></i> Flip Camera</button>
                </div>
                <div class="capture-btn-group d-none">
                    <label class="d-none" for="capture-button d-none">Capture</label>
                    <button id="capture-button" class="btn btn-primary mt-3">

                    </button>
                </div>


                <div id="label-container"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>



    <script type="module">
        const URL = "./my_model/"; // Path to your model files

        let model, webcam, labelContainer, maxPredictions;



        async function init(isBackCam = true) {
            const modelURL = URL + "model.json";
            const metadataURL = URL + "metadata.json";


            // Load the model and metadata
            model = await tmImage.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            setCamera(isBackCam);

        }

        async function setCamera(isBackCam) {
            let cameraFacing = "user";
            if (isBackCam) {
                cameraFacing = "environment";
            }

            if (webcam) {
                await webcam.stop();
            }

            // Setup webcam
            const flip = false; // Default to front camera
            webcam = new tmImage.Webcam(640, 480, flip); // Initial dimensions for desktop
            await webcam.setup({
                facingMode: cameraFacing,
                frameRate: 60
            });
            await webcam.play();
            window.requestAnimationFrame(loop);

            // Append webcam element to the DOM
            const webcamContainer = document.getElementById("webcam-container");
            const existingCanvas = webcamContainer.querySelector('canvas');
            const captureBtn = webcamContainer.nextElementSibling;

            // Check if there's already a canvas of cam preview
            if (existingCanvas) {
                // Remove the existing cam preview
                webcamContainer.removeChild(existingCanvas);
            }

            // Now append the webcam canvas
            webcamContainer.appendChild(webcam.canvas);

            labelContainer = document.getElementById("label-container");

            captureBtn.classList.remove('d-none');
        }

        async function loop() {
            webcam.update(); // Update the webcam frame
            window.requestAnimationFrame(loop);
        }

        async function predict() {
            const prediction = await model.predict(webcam.canvas);
            let highestProbability = 0;
            let highestClass = "";

            for (let i = 0; i < maxPredictions; i++) {
                if (prediction[i].probability > highestProbability) {
                    highestProbability = prediction[i].probability;
                    highestClass = prediction[i].className;
                }
            }

            // Check the highest class name in the database
            checkArtworkInDatabase(highestClass);
        }

        function checkArtworkInDatabase(artworkName) {
            fetch('check_artwork.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        artwork_name: artworkName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Populate and show the modal
                        document.getElementById('modal-image').src = data.artwork_img;
                        document.getElementById('modal-title').textContent = data.artwork_name;
                        document.getElementById('modal-artist').textContent = data.artwork_artist;
                        document.getElementById('modal-year').textContent = data.artwork_year;
                        document.getElementById('modal-medium').textContent = data.artwork_medium;
                        document.getElementById('modal-description').textContent = data.artwork_description;
                        $('#cardModal').addClass('modal-from-bottom').modal('show');
                    } else {
                        $('#no-art').modal('show');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        let flipCameraToggle = false;

        // Automatically initialize when the page loads
        window.addEventListener('load', init);

        // Add event listener to the capture button
        document.getElementById('capture-button').addEventListener('click', predict);

        // Add event listener to flip camera button
        document.getElementById('flip-camera-btn').addEventListener('click', function() {
            setCamera(flipCameraToggle);
            flipCameraToggle = !flipCameraToggle;
        });
    </script>

    <!-- Card Modal -->
    <div id="cardModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center><img id="modal-image" class="img-fluid" alt="Artwork Image"></center>
                    <br>
                    <p><b>Artist: </b><span id="modal-artist"></span></p>
                    <p><b>Year: </b><span id="modal-year"></span></p>
                    <p><b>Medium: </b><span id="modal-medium"></span></p>
                    <p><b>Description: </b><span id="modal-description"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="textToSpeechBtn">Text to Speech</button>
                </div>
            </div>
        </div>
    </div>


    <div id="no-art" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>
                        The artwork is not available or is not recognized.
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>