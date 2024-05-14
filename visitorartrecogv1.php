<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object Detection</title>
    <style>
        #container {
            width: 640px;
            height: 480px;
            position: relative;
            margin: 0 auto;
        }
        #videoElement, #canvasElement {
            width: 100%;
            height: 100%;
        }
        #canvasElement {
            position: absolute;
            top: 0;
            left: 0;
        }
        #modal {
            position: fixed;
            bottom: -100%;
            left: 0;
            width: 100%;
            z-index: 3;
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #ccc;
            transition: bottom 0.3s ease; /* Added transition for smooth sliding */
        }
        #modalHeader {
            cursor: pointer;
            margin-bottom: 10px;
            text-align: center;
        }
        #modalBody {
            display: none;
        }
        #backButton {
            display: block;
            margin-top: 10px;
            text-align: center;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
</head>
<body>
    <a type="button" href="visitorindex.html">Back</a>
    <div id="container">
        <video id="videoElement" autoplay></video>
        <canvas id="canvasElement"></canvas>
    </div>
    <div id="modal">
        <div id="modalHeader">Detected: <span id="modalHeaderText"></span></div>
        <div id="modalBody">
            <p id="modalDetails">This is the modal details.</p>
            <button id="backButton">Back</button>
        </div>
    </div>

    <script>
        async function runObjectDetection() {
            const video = document.getElementById('videoElement');
            const canvas = document.getElementById('canvasElement');
            const modal = document.getElementById('modal');
            const modalHeader = document.getElementById('modalHeader');
            const modalBody = document.getElementById('modalBody');
            const backButton = document.getElementById('backButton');
            const context = canvas.getContext('2d');
            let frameCount = 0;
            
            try {
                const model = await cocoSsd.load();
                
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(stream) {
                        video.srcObject = stream;
                    })
                    .catch(function(err) {
                        console.error("getUserMedia error:", err);
                    });

                video.addEventListener('loadeddata', async function() {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    setInterval(async () => {
                        frameCount++;
                        if (frameCount % 2 === 0) {
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            const predictions = await model.detect(video);
                            if (predictions.length > 0) {
                                // Slide up the modal
                                modal.style.bottom = '0';
                                modal.style.display = 'block';
                                modalBody.style.display = 'block';
                            } else {
                                // Slide down the modal
                                modal.style.bottom = '-100%';
                                modal.style.display = 'none';
                                modalBody.style.display = 'none';
                            }
                        }
                    }, 1000 / 30);
                });

                modalHeader.addEventListener('click', function() {
                    // Slide up the modal
                    modal.style.top = '0';
                    modal.style.display = 'block';
                    modalBody.style.display = 'block';
                });

                backButton.addEventListener('click', function() {
                    // Slide down the modal
                    modal.style.bottom = '-100%';
                    modalBody.style.display = 'none';
                });
            } catch (error) {
                console.error("Model loading error:", error);
            }
        }

        runObjectDetection();
    </script>
</body>
</html>
