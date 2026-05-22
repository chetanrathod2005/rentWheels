<?php
session_start();
include '../db.php';

if (!isset($_SESSION["admin_id"])) {
    header("location:../index.php?page=home");
    exit();
}
$email = $_SESSION["admin_email"];
$id = $_SESSION['admin_id'];
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin_css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css"  />
    <link rel="stylesheet" href="../datatable/datatables.min.css">
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
                    <i class="ri-dashboard-line"></i> Dashboard</a>
            </li>
            <li>
                <a href="dashboard.php?page=registered_user">
                    <i class="ri-user-fill"></i></i> Registered User</a>
            </li>
            <li>
                <a href="dashboard.php?page=brand">
                    <i class="ri-remix-line"></i> Brand</a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" onclick="toggleDropdown('twMenu')">
                    <i class="ri-motorbike-fill"></i> Two Wheeler
                    <i class="ri-arrow-down-s-line"></i>
                </a>
                <ul class="submenu" id="twMenu">
                    <li><a href="dashboard.php?page=add_tw">Add Bike</a></li>
                    <li><a href="dashboard.php?page=manage_tw">Manage Bike</a></li>

                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" onclick="toggleDropdown('fwMenu')">
                    <i class="ri-car-fill"></i> Four Wheeler
                    <i class="ri-arrow-down-s-line"></i>
                </a>
                <ul class="submenu" id="fwMenu">
                    <li><a href="dashboard.php?page=add_fw">Add Car</a></li>
                    <li><a href="dashboard.php?page=manage_fw">Manage Car</a></li>
                </ul>
            </li>
            <li>
                <a href="dashboard.php?page=tw_booking">
                    <i class="ri-motorbike-line"></i> Two Wheeler Booking</a>

            </li>
            <li>
                <a href="dashboard.php?page=fw_booking">
                    <i class="ri-car-line"></i> Four Wheeler Booking</a>
            </li>
            <li>
                <a href="dashboard.php?page=tw_report">
                    <i class="ri-file-chart-line"></i> Two Wheeler Report</a>
            </li>
            <li>
                <a href="dashboard.php?page=fw_report">
                    <i class="ri-file-chart-line"></i> Four Wheeler Report</a>
            </li>
            <li>
                <a href="dashboard.php?page=inquiry_request">
                    <i class="ri-question-mark"></i> inquiry Request</a>
                </a>
            </li>
            <li>
                <a href="#" onclick="logoutPopup()">
                    <i class="ri-logout-box-fill"></i> Logout</a>
            </li>
        </ul>
    </div>

    <!--logout popup model  -->
    <div id="logout_model">
        <div class="logout">
            <p>Are you sure you want to logout?</p>
            <button class="logout_btn" onclick="logout()">Logout</button>
            <button class="logout_cancel_btn" onclick="logout_cancel()">cancel</button>
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
        <h3>Welcome ADMIN</h3>
        <p>This is admin dashboard</p>
    </div>
    </div>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : "welcome";
        if ($page == "welcome") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/welcome.css'>";
            include 'welcome.php';
            
        } elseif ($page == "registered_user") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/registered_user.css'>";
            include "registered_user.php";
            
        } elseif ($page == "brand") {
             echo "<link rel=stylesheet href='../assets/css/admin_css/brand.css'>";
            include "../admin/brand/brand.php";
           
        } elseif ($page == "add_tw") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/tw.css'>";
            include "../admin/two_wheeler/tw_crud/add_tw.php";
            
        } elseif ($page == "manage_tw") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/manage_tw.css'>";
            include '../admin/two_wheeler/tw_crud/manage_tw.php';

        } elseif ($page == "add_fw") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/tw.css'>";
            include "../admin/four_wheeler/fw_crud/add_fw.php";

        } elseif ($page == "tw_booking") {
            include '../admin/two_wheeler/tw_booking/tw_booking.php';

        } elseif ($page == "manage_fw") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/manage_tw.css'>";
            include "../admin/four_wheeler/fw_crud/manage_fw.php";

        } elseif ($page == "fw_booking") {
            include "../admin/four_wheeler/fw_booking/fw_booking.php";

        } elseif ($page == "tw_report") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/vehicle_report.css'>";
            include "../admin/two_wheeler/tw_report.php";

        } elseif ($page == "fw_report") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/vehicle_report.css'>";
            include "../admin/four_wheeler/fw_report.php";

        } elseif ($page == "inquiry_request") {
            echo "<link rel=stylesheet href='../assets/css/admin_css/inquiry.css'></link>";
            include "../admin/inquiry/inquiry_request.php";
        }
        ?>
    </div>
    <script src="../assets/js/admin_dashboard.js"></script>
    <script src="../datatable/jquery.js"></script>
    <script src="../datatable/datatables.min.js"></script>

    <script>
        new DataTable("#user_table", {
            pageLength:10
        });
        new DataTable("#tw_booking", {
            pageLength:10
        })
        new DataTable("#fw_booking", {
            pageLength:10
        })
    </script>
</body>

</html>