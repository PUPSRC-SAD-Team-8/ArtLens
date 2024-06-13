
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/visitorquiz.css">
    <!-- FontAweome CDN Link for Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
        .info_box{
    width: 540px;
    max-width: 400px;
    background: #fff;
    border-radius: 5px;
    transform: translate(-50%, -50%) scale(0.9);
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
}
.quiz_box{
    width: 550px;
    max-width: 400px;
    background: #fff;
    border-radius: 5px;
    transform: translate(-50%, -50%) scale(0.9);
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
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
    <div class="blue-container">
        <br><br>
        <div class="container">
            <center><h1 style="color: white; font-family: 'Arial Grook', sans-serif;"><b>Rizal Shrine</b></h1>
            <br>
            <p style="color: white; font-size: 20px;">Welcome to the Museum Quiz! Get ready to test your knowledge and explore art, history, and culture!</p>
            <div class="start_btn" style="font-size: 30px; text-decoration: none; padding: 15px;"><button style="border: 0px;">Start Quiz</button></div>    
        </center>
            
        </div>
    </div>
    <!-- start Quiz button -->
    <center><h1 style="color: white; font-family: 'Arial Grook', sans-serif;"><b>Rizal Shrine</b></h1>
        <br>
        <p style="color: white; font-size: 20px;">Welcome to the Museum Quiz! Get ready to test your knowledge and explore art, history, and culture!</p></center>
    

    <!-- Info Box -->
    <div class="info_box" style="min-width: 10px !important;">
        <div class="info-title"><span>Some Rules of this Quiz</span></div>
        <div class="info-list">
            <div class="info">1. You will have only <span>15 seconds</span> per each question.</div>
            <div class="info">2. Once you select your answer, it can't be undone.</div>
            <div class="info">3. You can't select any option once time goes off.</div>
            <div class="info">4. You can't exit from the Quiz while you're playing.</div>
            <div class="info">5. You'll get points on the basis of your correct answers.</div>
        </div>
        <div class="buttons">
            <button class="quit">Exit Quiz</button>
            <button class="restart">Continue</button>
        </div>
    </div>

    <!-- Quiz Box -->
    <div class="quiz_box">
        <header>
            <div class="title">ArtLens Quiz</div>
            <div class="timer">
                <div class="time_left_txt">Time Left</div>
                <div class="timer_sec">15</div>
            </div>
            <div class="time_line"></div>
        </header>
        <section>
            <div class="que_text">
                <!-- Here I've inserted question from JavaScript -->
            </div>
            <div class="option_list">
                <!-- Here I've inserted options from JavaScript -->
            </div>
        </section>

        <!-- footer of Quiz Box -->
        <footer>
            <div class="total_que">
                <!-- Here I've inserted Question Count Number from JavaScript -->
            </div>
            <button class="next_btn">Next Que</button>
        </footer>
    </div>

    <!-- Result Box -->
    <div class="result_box">
        <div class="icon">
            <i class="fas fa-crown"></i>
        </div>
        <div class="complete_text">You've completed the Quiz!</div>
        <div class="score_text">
            <!-- Here I've inserted Score Result from JavaScript -->
        </div>
        <div class="buttons">
            <button class="restart">Replay Quiz</button>
            <button class="quit">Quit Quiz</button>
        </div>
    </div>

    <!-- Inside this JavaScript file I've inserted Questions and Options only -->
    <script src="js1/questions.js"></script>

    <!-- Inside this JavaScript file I've coded all Quiz Codes -->
    <script src="js1/script.js"></script>

</body>
</html>