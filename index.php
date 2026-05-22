<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vehicle Rental System</title>
<link rel="stylesheet" href="assets/css/index.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>

<header>
    <div class="logo"><img src="assets/images/hero_img/logo.png"></div>
    <nav>
        <a href="index.php?page=home">Home</a>
        <a href="index.php?page=about">About</a>
        <a href="index.php?page=vehicle">Vehicles</a>
        <a href="index.php?page=contact">Contact</a>
        <a href="index.php?page=home&show=login">Login/Register</a>
    </nav>
</header>

      <?php
       $page=isset($_GET["page"])?$_GET["page"]:"home";
       if($page=="home") {
        include("pages/home.php");
       } elseif($page=="about") {
            include("pages/about.php");
         } elseif($page=="vehicle") {
            include("pages/vehicle.php");
         } elseif($page=="contact") {
            include("pages/contact.php");
         } else {
            include("pages/home.php");
         }
         
        
        ?>

<footer>
    <p>© 2026 RentWheels | All Rights Reserved</p>
</footer>

</body>
</html>