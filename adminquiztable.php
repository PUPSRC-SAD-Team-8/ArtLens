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
                        <div class="accordion" id="accordionExample">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Quiz1
                </button>
                </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body" style="width: 60%;">
                    <form action="#">
                        <p>Please select your favorite Web language:</p>
                          <input type="radio" id="html" name="fav_language" value="HTML">
                          <label for="html">HTML</label><br>
                          <input type="radio" id="css" name="fav_language" value="CSS">
                          <label for="css">CSS</label><br>
                          <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                          <label for="javascript">JavaScript</label>

                        <br>  

                        <p>Please select your age:</p>
                        <input type="radio" id="age1" name="age" value="30">
                        <label for="age1">0 - 30</label><br>
                        <input type="radio" id="age2" name="age" value="60">
                        <label for="age2">31 - 60</label><br>  
                        <input type="radio" id="age3" name="age" value="100">
                        <label for="age3">61 - 100</label><br><br>
                        <button class="btn btn-primary">Edit</button>
                        </form>
                        
                    </div>
                        </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Quiz 2
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <h1>Sample Question: What is this artwork?</h1>
                                        <p>Show image if there is, but if no, display image upload field</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
   
    </body>
</html>

<?php
} else {
    header("Location: index.php");
    die();
}
?>
