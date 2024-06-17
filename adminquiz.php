<?php
session_start();
include('connection.php');

if (isset($_SESSION['userid'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/adminquiz.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <title>Artlens</title>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" style="position: relative;">
            <?php include('sidebar.php'); ?>
        </aside>

        <div class="main">
            <?php include('header.php'); ?>

            <main class="content px-4 py-5">
                <div class="container">
                    <a href="adminquiz.php" class="active-link">Quiz Form</a>&emsp;
                    <span><a href="adminquiztable.php" style="color: black;">Saved Quiz</a></span>
                    <div class="mt-3" style="height: 40px; background-color: #4169E1;"></div>
                    <div class="container justify-content-center" style="background-color: white;">
                        <br>
                        <div class="container mt-5 containerbig">
                            <h1 class="mb-4">Quiz Form</h1>
                            <form id="quizForm" action="processquiz.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                            <label for="quizTitle">Quiz Title</label>
                                            <input type="text" class="form-control" name="quizTitle" placeholder="Enter Quiz Title" required>
                                        </div>
                                <div id="questionsContainer">
                                    <div class="question mb-4 mt-3">
                                        <h4 class="question-number">Question 1<button type="button" class="delete-question-btn">&times;</button></h4>
                                        
                                        <div class="form-group mt-3">
                                            <label for="question">Question</label>
                                            <input type="text" class="form-control" name="questions[]" placeholder="Enter your question" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="questionImage">Upload Image</label>
                                            <input type="file" id="image-upload" name="images[]" class="form-control mb-3 formsize" accept="image/*">
                                        </div>
                                        <!-- Add hidden input field to store image filename -->
                                        <input type="hidden" name="imageFilenames[]" value="">
                                        <div class="optionsContainer"></div>
                                        <button type="button" class="btn btn-info btn-sm mt-2 addOption" style="background-color: #4169E1; color: white;">Add Option</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success mt-3" id="addQuestion">Add Question</button>
                                <button type="submit" class="btn btn-block mt-3 float-end" style="background-color: #4169E1; color: white;">Submit Quiz</button>
                            </form>

                            <br>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>

                        <script>
                            $(document).ready(function() {
                                function addOptionsContainer(optionsContainer, optionNumber, questionIndex) {
                                    let optionValue = optionNumber - 1;
                                    let optionHTML = `
                                        <div class="form-check mt-2 d-flex align-items-center">
                                            <input class="form-check-input me-2" type="radio" name="correctAnswer[${questionIndex}]" value="${optionValue}" required>
                                            <input type="text" class="form-control me-2" name="options[${questionIndex}][]" placeholder="Enter option ${optionNumber}" required>
                                            <button type="button" class="delete-option-btn">&times;</button>
                                        </div>
                                    `;
                                    optionsContainer.append(optionHTML);
                                }

                                function renumberOptions(optionsContainer) {
                                    optionsContainer.find('.form-check').each(function(index) {
                                        $(this).find('.form-check-input').val(index);
                                        $(this).find('input[type="text"]').attr('placeholder', `Enter option ${index + 1}`);
                                    });
                                }

                                function renumberQuestions() {
                                    $('#questionsContainer .question').each(function(index) {
                                        $(this).find('.question-number').html(`Question ${index + 1}<button type="button" class="delete-question-btn">&times;</button>`);
                                    });
                                }

                                $('#questionsContainer').on('click', '.addOption', function() {
                                    let optionsContainer = $(this).closest('.question').find('.optionsContainer');
                                    let optionCount = optionsContainer.find('.form-check').length;
                                    let questionIndex = $(this).closest('.question').index('.question');

                                    if (optionCount < 10) {
                                        addOptionsContainer(optionsContainer, optionCount + 1, questionIndex);
                                    } else {
                                        alert("You can only add up to 10 options.");
                                    }
                                });

                                $('#addQuestion').click(function() {
                                    let newQuestion = `
                                        <div class="question mb-4">
                                            <h4 class="question-number">Question ${$('#questionsContainer .question').length + 1}<button type="button" class="delete-question-btn">&times;</button></h4>
                                            <div class="form-group">
                                                <label for="question">Question</label>
                                                <input type="text" class="form-control" name="questions[]" placeholder="Enter your question" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="questionImage">Upload Image</label>
                                                <input type="file" id="image-upload" name="images[]" class="form-control mb-3 formsize"
                                                accept="image/*">
                                            </div>
                                            <div class="optionsContainer"></div>
                                            <button type="button" class="btn btn-info btn-sm mt-2 addOption" style="background-color: #4169E1; color: white;">Add Option</button>
                                        </div>
                                    `;
                                    $('#questionsContainer').append(newQuestion);
                                    renumberQuestions();
                                });

                                $('#questionsContainer').on('click', '.delete-question-btn', function() {
                                    $(this).closest('.question').remove();
                                    renumberQuestions();
                                });

                                $('#questionsContainer').on('click', '.delete-option-btn', function() {
                                    $(this).closest('.form-check').remove();
                                    let optionsContainer = $(this).closest('.optionsContainer');
                                    renumberOptions(optionsContainer);
                                });
                            });

                        </script>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>
<?php
} else {
    header("Location: index.php");
    die();
}
?>