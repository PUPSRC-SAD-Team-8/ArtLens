<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/visitorindex.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <style>
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
           /* Apply animation */
        }
        .draggable-modal {
            cursor: move;
        }
        /* Make the anchor tag behave like a block element */
        .card-link {
            display: block;
            color: inherit; /* Inherit text color from parent */
            text-decoration: none; /* Remove default underline */
        }
        .btn1{
            padding: 10px ;
            background-color:white !important;
            color: #4169E1;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn1:hover{
            background-color: #4169E1 !important;
            border: 1px solid white !important;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="head navbar navbar-expand-lg navbar-expand-md navbar-dark bg-primary">
        <div class="container" >
            <h1 style="color: white; font-family: 'Arial Grook', sans-serif; "><b >ArtLens</b></h1>
            <a class="btn1" href="index.php">Home</a>
        </div>
    </nav>
    <div class="container mb-5" style="margin-top: 44px;">
        <div class="row">
            <?php
                include('connection.php');
                $sql = "SELECT * FROM artwork";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
            ?>     
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 grid-container mt-3">
                <a href="#" class="card-link" data-toggle="modal" data-target="#artworkModal" data-img="<?php echo $row["artwork_img"]; ?>" data-description="<?php echo $row["artwork_description"]; ?>" data-title="<?php echo $row["artwork_name"]; ?>">
                    <div class="card">
                        <img src="<?php echo $row["artwork_img"]; ?>" class="card-img-top image" height="200" width="150" alt="Artwork Image">
                        <div class="card-title text-center">
                            <?php echo $row["artwork_name"]; ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php   
                    }
                } 
            ?>
        </div>
    </div>


<div class="modal modal-from-bottom draggable-modal" id="artworkModal" tabindex="-1" role="dialog" aria-labelledby="artworkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="ArtworkTitle"></h5>
                <button type="button" class="btn-close" data-dismiss="modal" id="toggleSpeechBtn1" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="card-img-top image" alt="Artwork Image" id="artworkImage">
                <br>
                <br>
                <button type="button" class="btn btn-primary float-end" id="toggleSpeechBtn"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-volume-up" viewBox="0 0 16 16">
                <path d="M11.536 14.01A8.47 8.47 0 0 0 14.026 8a8.47 8.47 0 0 0-2.49-6.01l-.708.707A7.48 7.48 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303z"/>
                <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.48 5.48 0 0 1 11.025 8a5.48 5.48 0 0 1-1.61 3.89z"/>
                <path d="M10.025 8a4.5 4.5 0 0 1-1.318 3.182L8 10.475A3.5 3.5 0 0 0 9.025 8c0-.966-.392-1.841-1.025-2.475l.707-.707A4.5 4.5 0 0 1 10.025 8M7 4a.5.5 0 0 0-.812-.39L3.825 5.5H1.5A.5.5 0 0 0 1 6v4a.5.5 0 0 0 .5.5h2.325l2.363 1.89A.5.5 0 0 0 7 12zM4.312 6.39 6 5.04v5.92L4.312 9.61A.5.5 0 0 0 4 9.5H2v-3h2a.5.5 0 0 0 .312-.11"/>
                </svg></button>
                <br>
                <p><b>Artist: </b><span id="artworkArtist"></span></p>
                <p><b>Year: </b><span id="artworkYear"></span></p>
                <p><b>Medium: </b><span id="artworkMedium"></span></p>
                <p><b>Description: </b><span id="artworkDescription"></span></p>
            </div>
        </div>
    </div>
</div>

    <div class="d-flex justify-content-end fixed-bottom fixed-end p-3">
    <div class="fixed-button">
        <div class="dropdown">
            <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-plus"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="visitorartrecog.php"><i class="fa-solid fa-camera"></i>&emsp;Art Recognition</a></li>
                <li><a class="dropdown-item" href="visitorquiz.php"><i class="fa-regular fa-file"></i>&emsp;Quiz</a></li>
            </ul>
        </div>
    </div>
</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.card-link').click(function(){
                var description = $(this).data('description');
                var imgSrc = $(this).data('img');
                var title = $(this).data('title');
                var artist = $(this).data('artist');
                var year = $(this).data('year');
                var medium = $(this).data('medium');
                $('#artworkDescription').text(description); 
                $('#artworkImage').attr('src', imgSrc);
                $('#ArtworkTitle').text(title);
                $('#artworkArtist').text(); 
                $('#artworkYear').text(); 
                $('#artworkMedium').text(); 
            });

            $('.draggable-modal').draggable({
                handle: '.modal-header'
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var isSpeaking = false;

            $('#toggleSpeechBtn').click(function() {
                isSpeaking = !isSpeaking;
                
                if (isSpeaking) {
                    startSpeech();
                } else {
                    stopSpeech();
                }

                
            });
            $('#toggleSpeechBtn1').click(function() {
                isSpeaking = !isSpeaking;
                
                if (isSpeaking) {
                    stopSpeech();
                } else {
                    stopSpeech();
                }
                
            });

            function startSpeech() {
                var title = $('#ArtworkTitle').text();
                var artist = $('#artworkArtist').text();
                var year = $('#artworkYear').text();
                var medium = $('#artworkMedium').text();
                var description = $('#artworkDescription').text();
                
                var artworkInfo = title + ". " + artist + ". " + year + ". " + medium + ". " + description;
                
                speakText(artworkInfo);
            }

            function speakText(text) {
                if ('speechSynthesis' in window) {
                    var message = new SpeechSynthesisUtterance(text);
                    window.speechSynthesis.speak(message);
                } else {
                    console.log('Speech synthesis not supported');
                }
            }

            function stopSpeech() {
                if ('speechSynthesis' in window) {
                    window.speechSynthesis.cancel();
                }
            }
        });
    </script>
</body>
</html>
