navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
        var video = document.getElementById('video');
        video.srcObject = stream;
        video.play();
    })
    .catch(function (err) {
        console.error('Error accessing the camera: ', err);
    });

document.getElementById('captureButton').addEventListener('click', function () {
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Convert canvas image to base64 data URL
    var imageData = canvas.toDataURL('image/jpeg');

    // Send the captured image data to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_image.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Image uploaded successfully');
        }
    };
    xhr.send('image=' + encodeURIComponent(imageData));
});
