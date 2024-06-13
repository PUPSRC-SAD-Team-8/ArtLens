<?php
session_start();
include ('connection.php');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <title>Artlens</title>
    <style>
        .active-link {
            color: white;
            background-color: #4169E1;
            padding: 10px;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
        }
        .edit-mode input {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" style="position: relative;">
            <?php include('sidebar.php'); ?>
        </aside>

        <!-- Main Component -->
        <div class="main">
            <?php include('header.php'); ?>

            <!--MAIN MAIN MAIN-->
            <main class="content px-4 py-5">
                <div class="container">
                    <a href="adminquiz.php" style="color: black;">Quiz Form</a>&emsp;
                    <span><a href="adminquiztable.php" class="active-link">Saved Quiz</a></span>

                    <div class="mt-3" style="height: 40px; background-color: #4169E1;"></div>
                    <form method="POST" action="adminquiztable.php">
                        <div class="accordion" id="accordionExample">
                            <?php
                            include ('quizedit.php');
                            $sql = "SELECT * FROM quiz_table";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $previousQuizId = null;
                                $quizContent = '';
                                while ($row = $result->fetch_assoc()) {
                                    $quizId = $row['quiz_id'];
                                    $quizTitle = $row['quiz_title'];
                                    $questionId = $row['question_id'];
                                    $question = $row['question'];
                                    $options = json_decode($row['options'], true);
                                    $correctAnswer = $row['correct_answer'];
                                    $imageFilename = $row['image_filenames']; // Assuming you have an image filename column

                                    if ($quizId !== $previousQuizId) {
                                        if ($previousQuizId !== null) {
                                            $quizContent .= '<button type="button" class="btn btn-primary mt-3 editButton" data-quiz-id="'.$previousQuizId.'">Edit</button>';
                                            $quizContent .= '<button type="submit" class="btn btn-success mt-3 saveButton" name="save_changes" style="display: none;">Save Changes</button>';
                                            $quizContent .= '<input type="hidden" name="quiz_id" value="'.$previousQuizId.'">';
                                            $quizContent .= '</div></div>';
                                        }
                                        $quizContent .= '<div class="accordion-item">';
                                        $quizContent .= '<h2 class="accordion-header">';
                                        $quizContent .= '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_' . $quizId . '" aria-expanded="false" aria-controls="collapse_' . $quizId . '">';
                                        $quizContent .= $quizTitle;
                                        $quizContent .= '</button></h2>';
                                        $quizContent .= '<div id="collapse_' . $quizId . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">';
                                        $quizContent .= '<div class="accordion-body">';
                                    }

                                    $quizContent .= '<div class="container mb-3">';
                                    $quizContent .= '<label>Question:</label>';
                                    $quizContent .= '<div class="mb-3 d-flex">';
                                    $quizContent .= '<input type="text" class="form-control edit-field" style="width: 90%;" name="questions['.$questionId.']" value="'.$question.'" disabled>';
                                    $quizContent .= '<button type="submit" class="btn btn-danger deleteQuestion ms-3" name="delete_question['.$quizId.'_'.$questionId.']" value="'.$questionId.'" style="display: none;">Delete</button>';
                                    $quizContent .= '</div>';
                                    $quizContent .= '<div><img src="quizimages/' . $imageFilename . '" alt="Question Image" style="width: 300px;"></div>'; 
                                    $quizContent .= '</div>';




                                    foreach ($options as $optionKey => $optionValue) {
                                        $quizContent .= '<div class="container">';
                                        $quizContent .= '<div class="form-check mb-2">';
                                        $quizContent .= '<div class="mb-3 d-flex">';
                                        $quizContent .= '<input class="form-check-input edit-field" type="radio" name="correctAnswers['.$questionId.']" value="'.$optionKey.'" '.(($optionKey==$correctAnswer)?'checked':'').' disabled>';
                                        $quizContent .= '&emsp;<input type="text" class="form-control edit-field" style="width: 50%;" name="options['.$questionId.']['.$optionKey.']" value="'.$optionValue.'" disabled>';
                                        $quizContent .= '<button type="button" class="btn btn-primary ms-3 removeOption" style="display: none;">Remove</button>';
                                        $quizContent .= '</div>';
                                        $quizContent .= '</div>';
                                        $quizContent .= '</div>';
                                    }

                                    $quizContent .= '<br>';

                                    $previousQuizId = $quizId;
                                }
                                if ($previousQuizId !== null) {
                                    $quizContent .= '<button type="button" class="btn btn-primary mt-3 editButton" data-quiz-id="'.$previousQuizId.'">Edit</button>';
                                    $quizContent .= '<button type="submit" class="btn btn-success mt-3 saveButton" name="save_changes" style="display: none;">Save Changes</button>';
                                    $quizContent .= '<input type="hidden" name="quiz_id" value="'.$previousQuizId.'">';
                                    $quizContent .= '</div></div></div>';
                                }
                                echo $quizContent;
                            } else {
                                echo "No quizzes found.";
                            } 
                            ?>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script> 
    
        document.querySelectorAll('.editButton').forEach(function(button) {
    button.addEventListener('click', function() {
        const quizId = this.getAttribute('data-quiz-id');
        const fields = document.querySelectorAll(`.accordion-body input[name^="questions"], .accordion-body input[name^="options"], .accordion-body input[name^="correctAnswers"]`);

fields.forEach(function(field) {
    if (field.closest(`.accordion-collapse`).id === `collapse_${quizId}`) {
        field.disabled = false;
    }
});

this.style.display = 'none';
this.nextElementSibling.style.display = 'block';
this.nextElementSibling.nextElementSibling.style.display = 'block';
document.querySelectorAll('.deleteQuestion').forEach(function(deleteButton) {
    deleteButton.style.display = 'inline-block';
});
document.querySelectorAll('.removeOption').forEach(function(removeButton) {
    removeButton.style.display = 'inline-block';
});
});
});

document.querySelectorAll('.deleteQuestion').forEach(function(deleteButton) {
deleteButton.addEventListener('click', function() {
const quizId = this.getAttribute('data-quiz-id');
const questionId = this.getAttribute('value');


if (confirmation) {
    // Send an AJAX request to delete the question
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'quizedit.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Reload the page after successful deletion
            location.reload();
        }
    };
    xhr.send(`quiz_id=${quizId}&question_id=${questionId}`);
}
});
});
</script>
</body>
</html>

<?php
} else {
    header("Location: index.php");
    die();
}
?>
