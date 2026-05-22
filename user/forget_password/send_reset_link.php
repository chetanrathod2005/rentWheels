<link rel="stylesheet" href="../../assets/css/user_css/send_reset_link.css">
<?php
include "../../db.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "../../vendor/autoload.php";
    $dotenv=Dotenv\Dotenv::createImmutable(__DIR__.'/../../');
    $dotenv->load();
    if(isset($_POST['send_link'])) {
    
    $email=trim($_POST['email']);

    $stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result=$stmt->get_result();
    
    if($result->num_rows>0) {
    $token=bin2hex(random_bytes(32));
    $expiry=date("Y-m-d H:i:s", strtotime("+10 minutes"));
    $stmt=$conn->prepare(" UPDATE users SET token=?, token_expiry=?
    WHERE email=?");
    $stmt->bind_param("sss",$token,$expiry,$email);
    if($stmt->execute()) {
       
        $reset_link="http://localhost/vrms/user/forget_password/reset_password.php?token=$token";
        
         $mail=new PHPMailer(true);

        try {
            $mail->isSMTP();

            $mail->Host='smtp.gmail.com';

            $mail->SMTPAuth=true;

            $mail->Username=$_ENV['MAIL_USERNAME'];

            $mail->Password=$_ENV['APP_PASSWORD'];

            $mail->SMTPSecure='tls';

            $mail->Port='587';

            $mail->setFrom($_ENV['MAIL_USERNAME'],$_ENV['APP_NAME']);

            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject="Reset Password";

            $mail->Body="
            
            <h3>Reset Your Password </h3>

            <p>click below link to reset your password</p>

            <p>$reset_link</p>
            <p>This link is expires in 10 Minutes</p>  
            <p>if you don't send request for reset password then ignore this mail</p>
                      
            ";

            $mail->send();
             $_SESSION['success_msg']="link is send to your mail address";

    } catch(Exception $e ) {
         echo $mail->ErrorInfo;
    }

    } else {
        $_SESSION['error_msg']= "some thing went wrong";
    }
    } else {
      $_SESSION['error_msg']="Email is not reigseted ";
    }

}
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="bg_img">
    <div class="header_info">
        <h2>Lost your key?</h2>
        <h4>Don't worry, we'll help you find it.</h4>
    </div>

    <div class="forget_password">
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

        <h2>Retrieve Your Password</h2>
        <p>Enter your email address and we'll send you a secure link to reset your password.</p>

        <form method="post">
            <label for="email">Email Address</label>    
            <input type="email" id="email" name="email" placeholder="Enter mail address" required>
            
            <button type="submit" name="send_link">Send Reset Link</button>
            <a href="../../index.php">← Back To Home Page</a>
        </form>
    </div>
</div>