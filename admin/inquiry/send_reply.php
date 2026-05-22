<?php
include '../../db.php';
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
if(isset($_POST['send_reply'])) {
    $contact_id=$_POST['contact_id'];
    $stmt=$conn->prepare("SELECT * FROM contact WHERE id=?");
    $stmt->bind_param("i",$contact_id);
    $stmt->execute();
    $result=$stmt->get_result();
    $inquiry=$result->fetch_assoc();

    $email=$inquiry['email'];
    $inquiry_type=$inquiry['inquiry_type'];
    $inquiry_msg=$inquiry['message'];
    $name=$inquiry['name'];

    $reply_msg = trim($_POST['reply_msg']);
    date_default_timezone_set("Asia/Kolkata");

    $reply_time = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("UPDATE contact SET reply_msg=?, reply_time=?, reply_status='resolved' WHERE id=?");
    $stmt->bind_param("ssi", $reply_msg,$reply_time,$contact_id);

    if($stmt->execute()) {
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

        $mail->Subject="This mail purpose is to solve your problem";

        $mail->Body="
        <p>Hello</p> <strong>$name</strong>
        <p>Your inquiry or problem is related to <strong>$inquiry_type</strong></p>
        <strong>Your  query: </strong> <p>$inquiry_msg</p>
        <strong>Our answer for your query </strong>
        <p>$reply_msg</p>
        </br>
        <p>Thank You</p>
        <p>Team VRMS</p>
        ";
        $mail->send();

        $_SESSION['success_msg']="reply send successfully";
    } catch(Exception $e) {
        $_SESSION['error_msg']= $mail->ErrorInfo;
    }
  }
}
?>