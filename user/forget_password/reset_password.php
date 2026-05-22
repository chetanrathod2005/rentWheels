<link rel="stylesheet" href="../../assets/css/user_css/send_reset_link.css">
<?php
include '../../db.php';
session_start();
if(isset($_GET['token'])) {
    $token=$_GET['token'];
    
    $stmt=$conn->prepare("SELECT * FROM users
     WHERE token=? AND token_expiry>NOW()");
    $stmt->bind_param("s",$token);
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows>0) {

      if(isset($_POST['reset_password'])) {
        
        $password=trim($_POST['password']);
        $confirm_pass=trim($_POST['confirm_pass']);

        if($password!==$confirm_pass) {
        $_SESSION['error_msg']="both password should same";
         header("Location:../../user/forget_password/reset_password.php?token=$token");
         exit();
        } elseif(strlen($password) < 8) {
         $_SESSION['error_msg']="Password lenght must be 8 or greater than 8";  
        header("Location:../../user/forget_password/reset_password.php?token=$token");
          exit();
        } else {
            $hash_password=password_hash($password,PASSWORD_DEFAULT);
            $password_stmt=$conn->prepare("UPDATE users SET password=?, token=NULL, token_expiry=NULL WHERE token=? ");
            $password_stmt->bind_param("ss",$hash_password,$token);
            if($password_stmt->execute()) {
             $_SESSION['success_msg']= "password changed successfully";
            } else {
             $_SESSION['error_msg']="Error occur while changing password";
            }
        }
      } 
    } else {
       $_SESSION['error_msg']="Invalid or expired reset link ";
    }
} else {
    $_SESSION['error_msg']="You are not authourized user for this service";
}
    
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="bg_img">
<div class="forget_password" >
<?php
if(isset($_SESSION['success_msg'])) {
    echo "<div class='success_msg'>{$_SESSION['success_msg']}</div>";
    unset($_SESSION['success_msg']);
} 
if(isset($_SESSION['error_msg'])) {
    echo "<div class='error_msg'>{$_SESSION['error_msg']}</div>";
    unset($_SESSION['error_msg']);
}
?>

<h2>Change Password</h2>

<form method="post">
<label for="password">Enter New Password:</label>    
<input type="password" name="password" id="password" required>
<span>Password length must be 8 or greater than 8</span>

<label for="confirm_pass">Enter Confirm Password</label>
<input type="password" name="confirm_pass" id="confirm_pass" required>
<span>Both password must same</span>

<button type="submit" name="reset_password">Reset Password</button>
 <a href="../../index.php">←Back To Home Page</a>
</form>
</div>

</div>