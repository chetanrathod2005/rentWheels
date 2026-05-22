<?php
session_start();
include "../db.php";
if(isset($_POST['register'])) {
    $name=trim($_POST['name']);
    $email=trim($_POST['email']);
    $mobile=trim($_POST['mobile']);
    $password=trim($_POST['password']);
    
    $_SESSION['active_form'] = 'register';
      if(empty($name) || empty($email) || empty($mobile) || empty($password)){
        $_SESSION['message']="All fields are required";
        header("location:../index.php?home&show=login");
    }

     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['message']="Invalid Email";
    }

    // MOBILE VALIDATION
    if(!preg_match("/^[0-9]{10}$/", $mobile)){
        $_SESSION['message']="Invalid Mobile Number";
        header("location:../index.php?home&show=login");
        exit();
    }
if(strlen($password)<8) {
    $_SESSION["message"]= "<p>Password must contain at least 8 character</p>";
    header("location:../index.php?page=home&show=login");
    exit();
}
    $checkEmail=$conn->prepare("SELECT * FROM users where email=?");
    $checkEmail->bind_param("s",$email);
    $checkEmail->execute();
    $checkEmail->store_result();
    if($checkEmail->num_rows>0) {
        $_SESSION["message"]= "<p>your email id already registered do login</p>";
        header("location:../index.php?page=home&show=login");
        exit();
}
    
    $hashpassword=password_hash($password,PASSWORD_DEFAULT);
    date_default_timezone_set("Asia/Kolkata");
    $current_time = date("Y-m-d H:i:s");
    $stmt=$conn->prepare("INSERT INTO users(name,email,mobile,password,	created_at) 
    values(?,?,?,?,?)");
    $stmt->bind_param("sssss",$name,$email,$mobile,$hashpassword,$current_time);
    if($stmt->execute()) {
        $_SESSION["success_msg"]="<p class='success_msg'>registration successfully done<p>";
    }
    $stmt->close();
     // send notification to admin
  
    $msg = $name. " with email id ".$email." is registered to rentWheels" ;
    date_default_timezone_set("Asia/Kolkata");

    $msg_time = date("Y-m-d H:i:s");
    $adminQuery = "SELECT id FROM users WHERE role='admin' ";
    $adminResult = $conn->query($adminQuery);
    $admin = $adminResult->fetch_assoc();
    $admin_id = $admin['id'];

    $sql = "INSERT INTO notifications (user_id, message,created_at) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss",$admin_id, $msg,$msg_time);
    $stmt->execute();

    header("Location:../index.php?page=home&show=login");
    exit();
}

   
?>
