<?php
session_start();
include '../db.php';
if (!isset($_SESSION["user_id"])) {
    header("location:../index.php?page=home");
    exit();
}
$id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT * FROM users where id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/user_css/dashboard.css">
</head>

<body>

    <!-- Hamburger Button -->
    <div class="menu-btn" onclick="toggleSidebar()">
        ☰
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="cross" id="cross"><i class="ri-close-fill"></i></div>
        <div class="logo">
            <img src="../assets/images/hero_img/logo.png">
        </div>

        <ul>
            <li>
                <a href="dashboard.php?page=welcome">
                <i class="ri-dashboard-line"></i> Dashboard</a></li>
            <li>
                <a href="dashboard.php?page=profile">
                <i class="ri-user-fill"></i></i> Profile</a>
            </li>
            <li class="dropdown">
            <a href="javascript:void(0)" onclick="toggleDropdown('rideMenu')">
                <i class="ri-car-fill"></i> Available Vehicle
                <i class="ri-arrow-down-s-line"></i>
            </a>
            <ul class="submenu" id="rideMenu">
                <li><a href="dashboard.php?page=available_tw">Two Wheeler</a></li>
                <li><a href="dashboard.php?page=available_fw">Four Wheeler</a></li>
            </ul>
        </li>
            <li>
                <a href="dashboard.php?page=my_booking">
                <i class="ri-clipboard-fill"></i> My Booking</a> 
            </li>
            <li>
                <a href="dashboard.php?page=contact">
                <i class="ri-mail-fill"></i> Contact</a>
            </li>
            <li>
                <a href="dashboard.php?page=change_password">
                <i class="ri-lock-unlock-fill"></i> Change Password</a>
            </li>
            <li>
                <a href="#" onclick="logoutPopup()"; >
                <i class="ri-logout-box-fill"></i> Logout</a>
            </li>
        </ul>
    </div>
   <!-- Logout Popup Model -->
    <div id="logout_model">
        <div class="logout">
            <p>Are you sure you want to logout?</p>
            <button class="logout_btn" type="submit" onclick="logout()">Logout</button>
            <button class="cancel_btn" type="button" onclick="logout_cancel()">cancel</button>
        </div>
    </div>
    <!-- Main Content -->
    <div class="main-content">
        <div class='welcome_msg'>

    <div class="notification" id="notification">
    <!-- Clicking this icon triggers the function -->
    <i class="ri-notification-3-fill" onclick="toggleNotiBox()"></i>
    <span class="notification_count" id="notification_count">0</span>

    <!-- The hidden box -->
    <div id="noti_box" class="noti-box">
        <div class="noti-header">
            <h3>Notifications</h3>
        </div>
        <div id="noti_list">
            <!-- Messages will appear here -->
             <p id="msg_time"></p>
            <p class="empty-msg">Not any notification</p>
        </div>
    </div>
</div>
    <div class="welcome_head_msg">
        <h3>Welcome, <?php echo $user['name']?></h3>
        <p>Enjoy Your Ride</p>
    </div>
    </div>
        
 <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "welcome";
    if($page=="welcome") {
        echo "<link rel=stylesheet href='../assets/css/user_css/welcome.css'>";
        include 'welcome.php';
    } elseif ($page == "profile") {
        echo "<link rel=stylesheet href='../assets/css/user_css/profile.css'>";
        include "profile.php";
    } elseif ($page == "available_tw") {
        echo "<link rel=stylesheet href='../assets/css/user_css/available_vehicle.css'>";
        include "tw_booking/available_tw.php";
    } elseif($page=="my_booking") {
        echo "<link rel=stylesheet href='../assets/css/user_css/mybook.css'>";
        include "my_book.php";
    } elseif ($page == "available_fw") {
        echo "<link rel=stylesheet href='../assets/css/user_css/available_vehicle.css'>";
        include "fw_booking/available_fw.php";
    }  elseif($page=="contact") {
        echo "<link rel='stylesheet' href='../assets/css/user_css/contact.css'>";
        include "contact.php";
    } elseif($page=="change_password") {
        include "change_password.php";
    } 
    ?>
   
    </div>
    <script src="../assets/js/user_dashboard.js"></script>
</body>
</html>