<?php
// session_start();
// session_destroy();
// header('location:index.php')
session_start();
unset($_SESSION["userid"]);
session_unset();
session_destroy();
header('location:admin.php');
