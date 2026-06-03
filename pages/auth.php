<?php 
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/auth.css">
    <title>Document</title>
     
</head>

<body>
    <div class="container">
        <div class="form-box">

            <div class="button-box">
                <button onclick="showLogin()" id="loginBtn">Login</button>
                <button onclick="showRegister()" id="registerBtn">Register</button>
                <div id="slider"></div>
            </div>

           <div class="login">
             <form id="loginForm" class="input-group" action="user/login.php" method="post">
                <input type="email" name="email" id="email" placeholder="Enter Email" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>
                <button type="submit" name="login" class="submit-btn">Login</button>
                <a href="user/forget_password/send_reset_link.php">Forgot Password?</a>
            </form>
           </div>

            <div class="register">
                <form id="registerForm" class="input-group" action="user/register.php" method="post">
                <input type="text" name="name" placeholder="Enter Name" required><br>
                <input type="email" name="email" placeholder="Enter Email" required><br>
                <input type="tel" name="mobile" placeholder="Enter Mobile Number"><br>
                <input type="password" name="password" placeholder="Password" minlength="8" required>
                <span class="password-note">Note: Password must contain at least 8 character</span>
                <button type="submit" class="submit-btn" name="register">Register</button>
            </form>
            </div>
  <?php
        if(isset($_SESSION["message"])) {
            echo "<div class='error_msg'>{$_SESSION['message']}</div>";
            unset($_SESSION["message"]);
        }
        if(isset($_SESSION["success_msg"])) {
            echo "<div>{$_SESSION['success_msg']}</div>";
            unset($_SESSION["success_msg"]);
        }
        ?>
        </div>
      
    </div>
</body>
<script>
    let loginForm = document.getElementById("loginForm");
    let registerForm = document.getElementById("registerForm");
    let slider = document.getElementById("slider");

    function showLogin() {
        loginForm.style.display = "flex";
        registerForm.style.display = "none";
        slider.style.left = "0%";
    }

    function showRegister() {
        loginForm.style.display = "none";
        registerForm.style.display = "flex";
        slider.style.left = "50%";
    }
      <?php
        if(isset($_SESSION['active_form']) && $_SESSION['active_form'] == 'register'){
            echo "showRegister();";
        } else {
            echo "showLogin();";
        }

        unset($_SESSION['active_form']);
    ?>
</script>

</html>