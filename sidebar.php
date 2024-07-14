<?php
// sidebar.php
function getCurrentScript() {
    return basename($_SERVER['SCRIPT_NAME']);
}
$current_script = getCurrentScript();
if (isset($_SESSION['userid'])) {
    $userId = $_SESSION['userid']; // Replace with actual user ID logic if needed

    // Fetch user data
    $sql = "SELECT firstName, lastName, middleInitial, employee_id, email, mobileNumber FROM login WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName, $middleInitial, $employeeId, $email, $mobileNumber);
    $stmt->fetch();
    $stmt->close(); }
?>

<div class="menu">
        <ion-icon name="menu-outline"></ion-icon>
        <ion-icon name="close-outline"></ion-icon>
    </div>

    <div class="sidebar-menu">
        <div>
            <div class="page-name">
                <ion-icon id="cloud" src="assets\icons\reorder-four-outline.svg"></ion-icon>
                <span style="color: blue;">&emsp;<b>Art<span style="color: black;">Lens</span></b></span>
            </div>
        </div>

        <nav class="navigation">
            <ul>
                <li>
                    <a id="<?php echo $current_script == 'adminindex.php' ? 'inbox' : ''; ?>" href="adminindex.php">
                        <ion-icon name="stats-chart-outline"></ion-icon>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a id="<?php echo $current_script == 'adminartwork.php' ? 'inbox' : ''; ?>" href="adminartwork.php">
                        <ion-icon name="extension-puzzle-outline"></ion-icon>
                        <span>Artworks</span>
                    </a>
                </li>
                <li>
                    <a id="<?php echo $current_script == 'adminannouncements.php' ? 'inbox' : ''; ?>" href="adminannouncements.php">
                        <ion-icon name="megaphone-outline"></ion-icon>
                        <span>Announcement</span>
                    </a>
                </li>
                <li>
                    <a id="<?php echo $current_script == 'adminbooking.php' ? 'inbox' : ''; ?>" href="adminbooking.php">
                        <ion-icon name="book-outline"></ion-icon>
                        <span>Booking</span>
                    </a>
                </li>
                <li>
                    <a id="<?php echo $current_script == 'adminvisitorlog.php' ? 'inbox' : ''; ?>" href="adminvisitorlog.php">
                        <ion-icon name="walk-outline"></ion-icon>
                        <span>Visitor Log</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div>
            <div class="user">
                <img src="assets/images/profile.png" alt="">
                <div class="user-info">
                    <div class="name-email">
                        <div class="name" id="user-name"><?php echo isset($firstName) ? $firstName : ''; ?></div>
                        <span class="email" id="user-email"><?php echo isset($email) ? $email : ''; ?></span>
                    </div>
                    </div>
                    <div class="dropup" style="cursor: pointer;">
                        <ion-icon name="ellipsis-vertical-outline" class="mt-3" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></ion-icon>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="adminaccount.php">Manage Account</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    