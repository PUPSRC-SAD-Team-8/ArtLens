<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ArtLens</title>
    <link rel="stylesheet" href="assets/css/visitorquiz.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <style>
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        .white-container {
            background-color: white;
            border-radius: 30px;
            position: absolute;
            top: 60%;
            left: 50%;
            height: 65vh;
            transform: translateX(-50%);
            z-index: 1;
            width: 87%; 
            padding: 20px; 
        }
        .blue-container {
            background-color: #4169E1;
            padding-top: 20px;
            position: relative;
            height: 115vh;
        }
        @media (max-width: 780px) {
            .white-container {
                width: 100%;
            }
        }
        .rectangle {
            min-width: 300px;
            max-width: 400px;
            height: 60px; /* Adjust height as needed */
            margin-bottom: 10px; /* Adjust margin as needed */
            border-radius: 5px; /* Adjust border radius as needed */
        }
    </style>
</head>
<body>
    <nav class="head navbar navbar-expand-lg navbar-expand-md navbar-dark">
        <div class="container">
            <h1 style="color: white; font-family: 'Arial Grook', sans-serif;"><b>ArtLens</b></h1>
            <a class="btn1" href="visitorindex.php" style="text-decoration: none;">Back</a>
        </div>
    </nav>
    <div class="row justify-content-center">
        <div class="container">
            <div class="blue-container">
                <br><br>
                <div class="container">
                    <center><h1 style="color: white; font-family: 'Arial Grook', sans-serif;"><b>Rizal Shrine</b></h1>
                    <br>
                    <p style="color: white; font-size: 20px;">Welcome to the Museum Quiz! Get ready to test your knowledge and explore art, history, and culture!</p>
                    <br><br>
                    <a class="btn1" href="index.php" style="font-size: 30px; text-decoration: none; padding: 15px;">Start Quiz</a>
                    </center>
                </div>
            </div>
        </div>
        <div class="container white-container ">
            <center><h3>Quiz Leaderboard</h3></center>
            <!-- Add three rectangles here -->
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <div class="rectangle" style="border: 2px solid gold; text-align: center; display: flex; justify-content: center; align-items: center;">
                        <div style="display: inline-block; width: 40%; text-align: left;">
                            <p style="display: inline; margin-left: 15px; margin-top: 10px;">1. John Doe</p>
                        </div>
                        <div style="display: inline-block; width: 40%; text-align: right;">
                            <p style="display: inline; margin-right: 15px; margin-top: 10px;">40 Points</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="rectangle" style="border: 2px solid silver; text-align: center; display: flex; justify-content: center; align-items: center;">
                        <div style="display: inline-block; width: 40%; text-align: left;">
                            <p style="display: inline; margin-left: 15px; margin-top: 10px;">2. Juan Cruz</p>
                        </div>
                        <div style="display: inline-block; width: 40%; text-align: right;">
                            <p style="display: inline; margin-right: 15px; margin-top: 10px;">40 Points</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="rectangle" style="border: 2px solid brown; text-align: center; display: flex; justify-content: center; align-items: center;">
                        <div style="display: inline-block; width: 40%; text-align: left;">
                            <p style="display: inline; margin-left: 15px; margin-top: 10px;">3. Gamer123</p>
                        </div>
                        <div style="display: inline-block; width: 40%; text-align: right;">
                            <p style="display: inline; margin-right: 15px; margin-top: 10px;">40 Points</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
