<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #webcam-container {
    margin-top: 20px;
    width: 100%;
    display: flex;
    justify-content: center;
    overflow: hidden; /* Ensure the webcam feed doesn't overflow its container */
}

#webcam-container video {
    width: 100%; /* Ensure the video fills the container width */
    height: auto; /* Maintain aspect ratio */
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>ArtLens</h1>
                <div id="webcam-container"></div>
                <button id="capture-button" class="btn btn-primary mt-3">Capture</button>
                <div id="label-container"></div>
            </div>
        </div>
    </div>

    <!-- Include TensorFlow.js and Teachable Machine Image script -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>

    <script type="text/javascript">
        const URL = "./my_model/"; // Path to your model files

        let model, webcam, labelContainer, maxPredictions;

        async function init() {
            const modelURL = URL + "model.json";
            const metadataURL = URL + "metadata.json";

            // Load the model and metadata
            model = await tmImage.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            // Setup webcam
            const flip = true;
            webcam = new tmImage.Webcam(200, 200, flip);
            await webcam.setup();
            await webcam.play();
            window.requestAnimationFrame(loop);

            // Append elements to the DOM
            document.getElementById("webcam-container").appendChild(webcam.canvas);
            labelContainer = document.getElementById("label-container");
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
            //labelContainer.innerHTML = "Highest accuracy class: " + highestClass + " (" + highestProbability.toFixed(2) + ")";
            
            // Check the highest class name in the database
            checkArtworkInDatabase(highestClass);
        }

        function checkArtworkInDatabase(artworkName) {
            fetch('check_artwork.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ artwork_name: artworkName })
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
                    alert("Artwork not found in the database.");
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Automatically initialize when the page loads
        window.addEventListener('load', init);

        // Add event listener to the capture button
        document.getElementById('capture-button').addEventListener('click', predict);
    </script>

    <!-- Card Modal -->
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



    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

    $(document).ready(function() {
        var isSpeaking = false;
        var speechSynthesis = window.speechSynthesis;
        var voices = [];

        // Fetch available voices and filter for Tagalog if needed
        speechSynthesis.onvoiceschanged = function() {
            voices = speechSynthesis.getVoices();
            // Uncomment below to filter for Tagalog voice
            // var tagalogVoice = voices.find(voice => voice.lang === 'tl-PH');
        };

        $('#textToSpeechBtn').click(function() {
            isSpeaking = !isSpeaking;

            if (isSpeaking) {
                startSpeech();
            } else {
                stopSpeech();
            }
        });

        function startSpeech() {
            var title = $('#modal-title').text();
            var artist = $('#modal-artist').text();
            var year = $('#modal-year').text();
            var medium = $('#modal-medium').text();
            var description = $('#modal-description').text();

            var textToSpeak = title + ". Artist: " + artist + ". Year: " + year + ". Medium: " + medium + ". Description: " + description;

            // Create speech synthesis utterance
            var speech = new SpeechSynthesisUtterance();
            speech.text = textToSpeak;
            // Uncomment below to set Tagalog voice
            // speech.voice = tagalogVoice;

            speechSynthesis.speak(speech);
        }

        function stopSpeech() {
            speechSynthesis.cancel();
        }
    });
</script>

</body>
</html>
