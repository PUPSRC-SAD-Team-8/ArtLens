<?php
// sidebar.php
function getCurrentScript() {
    return basename($_SERVER['SCRIPT_NAME']);
}
$current_script = getCurrentScript();
?>

<div class="h-100">
    <center>
        <br>
        <img src=assets/images/logo.png class="img-fluid" style="width: 70px;" alt="logo">
        <div class="sidebar-logo">
            <h4 style="color: #4169E1;"><b>ArtLens</b></h4>
            <hr>
        </div>
    </center>
    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="adminindex.php" class="sidebar-link mx-2 <?php echo $current_script == 'adminindex.php' ? 'active' : ''; ?>">
                <i class="fa-regular fa-address-card pe-2"></i>
                Dashboard
            </a>
        </li>
        <li class="sidebar-item">
            <a href="adminartwork.php" class="sidebar-link mx-2 <?php echo $current_script == 'adminartwork.php' ? 'active' : ''; ?>">
                <i class="fa-solid fa-palette pe-2"></i>
                Artworks
            </a>
        </li>
        <li class="sidebar-item">
            <a href="adminannouncements.php" class="sidebar-link mx-2 <?php echo $current_script == 'adminannouncements.php' ? 'active' : ''; ?>">
                <i class="fa-solid fa-bullhorn pe-2"></i>
                Announcements
            </a>
        </li>
        <li class="sidebar-item">
            <a href="adminquiz.php" class="sidebar-link mx-2 <?php echo $current_script == 'adminquiz.php' ? 'active' : ''; ?>">
                <i class="fa-regular fa-newspaper pe-2"></i>
                Quiz
            </a>
        </li>
        <li class="sidebar-item">
            <a href="adminbooking.php" class="sidebar-link mx-2 <?php echo $current_script == 'adminbooking.php' ? 'active' : ''; ?>">
                <i class="fa-solid fa-book-open pe-2"></i>
                Booking
            </a>
        </li>
        <li class="sidebar-item">
            <a href="adminvisitorlog.php" class="sidebar-link mx-2 <?php echo $current_script == 'adminvisitorlog.php' ? 'active' : ''; ?>">
                <i class="fa-solid fa-person pe-2"></i>
                Visitor Log
            </a>
        </li>
        <li class="sidebar-item">
            <a href="logout.php" class="sidebar-link mx-2" style="margin-top: 30%; color: red;">
                <i class="fa-solid fa-right-from-bracket pe-2"></i>
                Logout
            </a>
        </li>
    </ul>
</div>

