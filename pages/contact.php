<?php
include 'db.php';
session_start();
if(isset($_POST['send_query'])) {
    $name=trim($_POST['name']);
    $email=trim($_POST['email']);
    $inquiry_type=trim($_POST['inquiry_type']);
    $message=trim($_POST['message']);
    $user_type='';

    if(empty($name) || empty($email) || empty($inquiry_type) || empty($message)){
    $_SESSION['error_msg']="All fields are required";
    header("location:index.php?page=contact");
    exit();
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user_type = "registered";
    } else {
        $user_type = "guest";
    }
   $stmt->close();
   date_default_timezone_set("Asia/Kolkata");

   $send_time = date("Y-m-d H:i:s");
   $stmt=$conn->prepare("INSERT INTO contact(name,email,user_type,inquiry_type,message,send_at)
   VALUES(?,?,?,?,?,?)");
   $stmt->bind_param("ssssss",$name,$email,$user_type,$inquiry_type,$message,$send_time);
   if($stmt->execute()) {
    $_SESSION['success_msg']="Your query is send successfully we will send replied in short time to your email address";
   } else {
    $_SESSION['error_msg']="something went wrong";
   }
    $msg=$name." whose email id is ". $email. " send query ";
    date_default_timezone_set("Asia/Kolkata");

    $msg_time = date("Y-m-d H:i:s");
    $adminQuery=$conn->prepare("SELECT id FROM users WHERE role='admin'");
    $adminQuery->execute();
    $result=$adminQuery->get_result();
    $admin=$result->fetch_assoc();
    $admin_id=$admin['id'];

    $sql = "INSERT INTO notifications (user_id, message,created_at) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss",$admin_id, $msg,$msg_time);
    $stmt->execute();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | VRMS</title>
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>
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
    <section class="contact-hero">
        <h1>Get in Touch</h1>
        <p>support for customer,people who want to join us</p>
    </section>

    <div class="container">
        <div class="contact-wrapper">
            
            <!-- Left Side: Contact Info -->
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p>Have a question about our Vehicle Rental Management System? Reach out to us directly.</p>
                
                <div class="info-item">
                    <i class="ri-phone-fill"></i>
                    <div>
                        <span>Call Us</span>
                        <p>+91 9876543210</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="ri-mail-fill"></i>
                    <div>
                        <span>Email Support</span>
                        <p>support@rentwheels.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="ri-map-pin-line"></i>
                    <div>
                        <span>Main Office</span>
                        <p>Bhavnagar </p>
                    </div>
                </div>

                <div class="social-links">
                    <a href="#"><i class="ri-facebook-line"></i></a>
                    <a href="#"><i class="ri-twitter-x-line"></i></a>
                    <a href="#"><i class="ri-linkedin-fill"></i></a>
                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="contact-form">
                <form method="post">
                    <input type="hidden" name="redirect_link" value="../index.php?page=contact">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="inquiry_type">Inquiry Type</label>
                        <input type="text" name="inquiry_type" id="inquiry_type" placeholder="inquiry type" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea rows="5" placeholder="How can we help you?" name="message" id="message" required></textarea>
                    </div>

                    <button type="submit" name="send_query" class="submit-btn">Send Message</button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>