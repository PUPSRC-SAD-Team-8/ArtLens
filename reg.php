<?php
    session_start();
    include('connection.php'); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        $query = mysqli_query($conn, "SELECT * FROM `login` WHERE username='$username'");
        if (mysqli_num_rows($query) > 0) {
            $_SESSION['msg'] = "Username already exists!";
            header('location: reg.php');
            exit(); 
        } else {
            $insert_query = mysqli_query($conn, "INSERT INTO `login` (username, password) VALUES ('$username', '$password')");
            if ($insert_query) {
                $_SESSION['msg'] = "<br>Registration successful! You can now login.";
                header('location: index.php');
                exit(); 
            } else {
                $_SESSION['msg'] = "Registration failed. Please try again later.";
                header('location: reg.php');
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <?php if (isset($_SESSION['msg'])): ?>
        <?php echo $_SESSION['msg']; ?>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>
    <form action="#" method="POST">
        <label for="uname">Username:</label><br>
        <input type="text" id="uname" name="uname" required><br>
        <label for="pass">Password:</label><br>
        <input type="password" id="pass" name="pass" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
