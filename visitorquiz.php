<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtLens</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome CDN Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Josefin+Sans" />
    <!-- Custom CSS -->
    <style>
        /* Custom CSS styles */

        .btn1{
    padding: 10px ;
    background-color:white !important;
    color: #4169E1;
    border-radius: 5px;
    text-decoration: none;
  }
  
  .homebtn:hover{
    background-color: #4169E1;
    border-color: white;
    color: #4169E1;
  }
  
  .head {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      width: 100% !important;
      z-index: 1000 !important;
      background-color: #4169E1 !important;
  }
  .titleh {
      color: white;
      
  }

        .info_box, .quiz_box, .result_box {
            width: 100%;
            max-width: 600px;
            background: #fff;
            border-radius: 5px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            

        }

        .info_box.activeInfo, .quiz_box.activeQuiz, .result_box.activeResult {
            opacity: 1;
            z-index: 5;
            pointer-events: auto;
            transform: translate(-50%, -50%) scale(1);
            
        }

        .info_box .info-title {
            height: 60px;
            width: 100%;
            border-bottom: 1px solid lightgrey;
            display: flex;
            align-items: center;
            padding: 0 30px;
            border-radius: 5px 5px 0 0;
            font-size: 20px;
            font-weight: 600;
            
        }

        .info_box .info-list {
            padding: 15px 30px;
        }

        .info_box .info-list .info {
            margin: 5px 0;
            font-size: 17px;
        }

        .info_box .info-list .info span {
            font-weight: 600;
            color: #007bff;
        }

        .info_box .buttons {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 30px;
            border-top: 1px solid lightgrey;
        }

        .info_box .buttons button {
            margin: 0 5px;
            height: 40px;
            width: 100px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            outline: none;
            border-radius: 5px;
            border: 1px solid #007bff;
            transition: all 0.3s ease;
        }

        .quiz_box header, .result_box .icon {
            font-size: 100px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .quiz_box header .title {
            font-size: 20px;
            font-weight: 600;
        }

        .quiz_box header .timer, .quiz_box header .time_line {
            background: #cce5ff;
            border: 1px solid #b8daff;
        }

        .quiz_box header .time_left_txt {
            font-weight: 400;
            font-size: 17px;
            user-select: none;
        }

        .quiz_box header .timer .timer_sec {
            font-size: 18px;
            font-weight: 500;
            height: 30px;
            width: 45px;
            color: #fff;
            border-radius: 5px;
            line-height: 30px;
            text-align: center;
            background: #343a40;
            border: 1px solid #343a40;
            user-select: none;
        }

        .quiz_box header .time_line {
            position: absolute;
            bottom: 0px;
            left: 0px;
            height: 3px;
            background: #007bff;
        }

        footer button {
            height: 40px;
            padding: 0 13px;
            font-size: 18px;
            font-weight: 400;
            cursor: pointer;
            border: none;
            outline: none;
            color: #fff;
            border-radius: 5px;
            background: #007bff;
            border: 1px solid #007bff;
            line-height: 10px;
            opacity: 0;
            pointer-events: none;
            transform: scale(0.95);
            transition: all 0.3s ease;
        }

        footer button:hover {
            background: #0263ca;
        }

        footer button.show {
            opacity: 1;
            pointer-events: auto;
            transform: scale(1);
        }

        .result_box {
            background: #fff;
            border-radius: 5px;
            display: flex;
            padding: 25px 30px;
            width: 450px;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            transform: translate(-50%, -50%) scale(0.9);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .result_box .icon {
            font-size: 100px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .result_box .complete_text {
            font-size: 20px;
            font-weight: 500;
        }

        .result_box .score_text span {
            display: flex;
            margin: 10px 0;
            font-size: 18px;
            font-weight: 500;
        }

        .result_box .score_text span p {
            padding: 0 4px;
            font-weight: 600;
        }

        .result_box .buttons {
            display: flex;
            margin: 20px 0;
        }

        .result_box .buttons button {
            margin: 0 10px;
            height: 45px;
            padding: 0 20px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            outline: none;
            border-radius: 5px;
            border: 1px solid #007bff;
            transition: all 0.3s ease;
        }

        .buttons button.restart {
            color: #fff;
            background: #007bff;
        }

        .buttons button.restart:hover {
            background: #0263ca;
        }

        .buttons button.quit {
            color: #007bff;
            background: #fff;
        }

        .buttons button.quit:hover {
            color: #fff;
            background: #007bff;
        }

        @media (max-width: 768px) {
            .blue-container {
                padding-top: 80px;
                height: auto;
            }

            .info_box, .quiz_box, .result_box {
                width: 90%;
            }

            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
<nav class="head navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <h1 style="color: white; font-family: Josefin Sans; margin-top: 15px; font-size: 25px;"><b>ARTLENS</b></h1>
            <a type="button" href="index.php" class="nav-link admin-login-mobile btn1 ">Back</a>
        </div>
    </nav>
    <div class="blue-container">
        <div class="container mt-5">
            <center>
                <h1 class="titleh"><b>Rizal Shrine</b></h1>
                <p class="titleh">Welcome to the Museum Quiz! Get ready to test your knowledge and explore art, history, and culture!</p>
                <div class="start_btn"><button>Start Quiz</button></div>
            </center>
        </div>
    </div>
    <!-- Info Box -->
     <div class="container">
    <div class="info_box">
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
    <div class="quiz_box mt-3" style="z-index: 111111;">
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
