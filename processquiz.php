<?php
session_start();
include('connection.php');

if (isset($_SESSION['userid']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $quizTitle = isset($_POST['quizTitle']) ? trim($_POST['quizTitle']) : '';
    $questions = isset($_POST['questions']) ? $_POST['questions'] : [];
    $correctAnswers = isset($_POST['correctAnswer']) ? $_POST['correctAnswer'] : [];
    $options = isset($_POST['options']) ? $_POST['options'] : [];

    // Validate quiz title (you can add more specific validation if needed)
    if (empty($quizTitle)) {
        // Handle empty quiz title
        echo "Quiz title is required.";
        exit(); // Exit script if validation fails
    }

    // Generate a new quiz_id
    $sql = "SELECT MAX(quiz_id) AS max_quiz_id FROM quiz_table";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $quizId = $row['max_quiz_id'] + 1;

    // Prepare the SQL statement
    $sql = "INSERT INTO quiz_table (quiz_id, quiz_title, question_id, question, options, correct_answer, image_filenames) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit();
    }

    // Initialize question_id counter
    $questionId = 1;

    // Loop through each question
    foreach ($questions as $index => $question) {
        // Retrieve the correct answer and options for each question
        $correctAnswer = isset($correctAnswers[$index]) ? $correctAnswers[$index] : '';
        $optionList = isset($options[$index]) ? $options[$index] : [];
        $optionJson = json_encode($optionList);

        // Handle file upload
        // Handle file upload
        $uploadedFiles = $_FILES['images'];
        $uploadedFileName = $uploadedFiles['name'][$index];
        $tempFilePath = $uploadedFiles['tmp_name'][$index];
        $targetFilePath = 'quizimages/' . $uploadedFileName; // Change the target directory to 'quizimages'

        // Move uploaded file to target directory
        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
            // File moved successfully, proceed with database insertion
            $imageFilename = $uploadedFileName;
        } else {
            // Failed to move file, handle error (e.g., display error message or log)
            $imageFilename = ''; // Set empty filename if file upload failed
        }


        // Bind parameters
        $stmt->bind_param("isissss", $quizId, $quizTitle, $questionId, $question, $optionJson, $correctAnswer, $imageFilename);

        // Execute the statement
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            exit();
        }

        // Increment question_id
        $questionId++;
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $conn->close();

    // Redirect after successful submission
    header("Location: adminquiztable.php");
    exit();
} else {
    // Redirect if user is not logged in or request method is not POST
    header("Location: index.php");
    exit();
}
?>
