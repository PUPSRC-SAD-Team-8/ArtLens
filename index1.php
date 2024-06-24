<?php
try {
    $replicateApiToken = 'r8_LNFIAtGEoGhdUQeQdPTQHqB7BaWvcbk0PvYpY'; //r8_JDo2Ztpjp4qovpu1IzRqqGaIYHlZMwI2Kldg6

    $curl = curl_init('https://api.replicate.com/v1/account');
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Bearer $replicateApiToken"]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
    $response = curl_exec($curl);
    $curlInfo = curl_getinfo($curl);
  
    if ($curlInfo['http_code'] !== 200) {
      throw new Exception("API request failed with status code: " . $curlInfo['http_code']);
    }
  
    curl_close($curl);
  
    // Process the response (assuming it's JSON)
    $responseData = json_decode($response, true);
    // Use the data from $responseData
  
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object Detection</title>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@3.10.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1>Object Detection</h1>
    <video id="video" width="640" height="480" autoplay></video>
    <canvas id="canvas" width="640" height="480"></canvas>
    <div id="output"></div>
    <button id="captureButton">Capture Image</button>

    <script>
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                var video = document.getElementById('video');
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err) {
                console.error("Error accessing the camera: " + err);
            });

        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');
        var outputDiv = document.getElementById('output');
        var captureButton = document.getElementById('captureButton');

        // async function detectObjects() {
        //     const model = await cocoSsd.load();
        //     context.drawImage(video, 0, 0, 640, 480);
        //     const predictions = await model.detect(video);
        //     outputDiv.innerHTML = '';

        //     predictions.forEach(async prediction => {
        //         outputDiv.innerHTML += `<p>${prediction.class}: ${prediction.score.toFixed(2)}</p>`;
        //         const prompt = `Describe the ${prediction.class}.`;
        //         const response = await generateInformation(prompt);
        //         outputDiv.innerHTML += `<p>${response}</p>`;
        //     });

        //     requestAnimationFrame(detectObjects);
        // }



        // detectObjects();

        captureButton.addEventListener('click', async function () {
            // Capture the current frame from the video and display it in the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            // Convert the canvas image to base64 data URL
            const imageDataUrl = canvas.toDataURL('image/png').replace("image/png", "image/octet-stream");
            // const imageDataUrl = canvas.toDataURL('image/png');
            const base64Response = await fetch(imageDataUrl);
            const blob = await base64Response.blob();
          
            const response = await generateInformation(imageDataUrl);
            // outputDiv.innerHTML += `<p>${response}</p>`;
        });
        async function generateInformation(prompt) {
            $.ajax({
          type: 'POST',
          data: {prompt: prompt},
          url: 'final.php',
          dataType: 'json',
          async: false,
          success: function(response) {
            outputDiv.innerHTML = '';
            outputDiv.innerHTML += `<p>${response.result}</p>`;
                }
         
        }); 
        }
    </script>
    
</body>
</html>

