<?php
include('connection.php');

if (!isset($_SESSION['userid'])) {
    header("Location: index.php");
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    $quizId = $_POST['quiz_id'];
    $questions = $_POST['questions'];
    $options = $_POST['options'];
    $correctAnswers = $_POST['correctAnswers'];

    foreach ($questions as $questionId => $questionText) {
        $correctAnswer = $correctAnswers[$questionId];
        $questionOptions = json_encode($options[$questionId]);

        $sql = "UPDATE quiz_table SET question = ?, options = ?, correct_answer = ? WHERE question_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $questionText, $questionOptions, $correctAnswer, $questionId);
        $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_question'])) {
    $questionId = $_POST['delete_question'];
    $quizId = $_POST['quiz_id'];

    $sql = "DELETE FROM quiz_table WHERE quiz_id = ? AND question_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $quizId, $questionId);
    $stmt->execute();
}
?>
