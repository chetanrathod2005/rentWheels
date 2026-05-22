<?php
include '../db.php';
$user_id=$_SESSION['user_id'];

$stmt=$conn->prepare("SELECT name,email FROM users WHERE id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result=$stmt->get_result();
$user=$result->fetch_assoc();

if(isset($_POST['send_query'])) {
$name=$user['name'];
$email=$user['email']; 
$inquiry_type=trim($_POST['inquiry_type']); 
$message=trim($_POST['message']);

if(empty($name) || empty($email) || empty($inquiry_type) || empty($message)){
    $_SESSION['error_msg']="All fields are required";
    header("Location:../user/dashboard.php?page=contact");
    exit();
}
$user_type="registered";
date_default_timezone_set("Asia/Kolkata");

$send_time = date("Y-m-d H:i:s");
$stmt=$conn->prepare("INSERT INTO contact(name,email,user_type,inquiry_type,message,send_at)
VALUES(?,?,?,?,?,?) ");
$stmt->bind_param("ssssss",$name,$email,$user_type,$inquiry_type,$message,$send_time);
if($stmt->execute())  {
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
<div class="contact-container">
    <h2>Contact Us</h2>
    <div class="contact-info">
        <div class="info-box">
            <i class="ri-phone-fill"></i>
            <p>+91 9876543210</p>
        </div>

        <div class="info-box">
            <i class="ri-mail-fill"></i>
            <p>support@rentwheels.com</p>
        </div>

        <div class="info-box">
          <i class="ri-map-pin-fill"></i>
            <p>India</p>
        </div>
    </div>

 <div class="contact-form">
    <form  method="POST">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" 
        value="<?php echo $user['name']?>"
        required readonly>

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" 
        value="<?php echo $user['email']?>"
        required readonly>

         <label for="inquiry_type">Inquiry Type</label>
        <input type="text" name="inquiry_type" id="inquiry_type" placeholder="inquiry Type" required>

        <label for="message">Message</label>
        <textarea rows="5" placeholder="How can we help you?" name="message" id="message" required></textarea>

        <button type="submit" name="send_query">Send Message</button>
    </form>
    </div>
</div>
