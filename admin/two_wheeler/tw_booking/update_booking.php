<?php
include "../../../db.php";
$booking_id=$_POST["booking_id"];
$stmt=$conn->prepare("SELECT book_to FROM booking WHERE id=?");
$stmt->bind_param("i",$booking_id);
$stmt->execute();
$result=$stmt->get_result();
$booking=$result->fetch_assoc();
if (date('Y-m-d') > $booking['book_to']) {
    echo "Cannot approve. Booking date already expired.";
    exit;
}
$stmt->close();

$update_status=$_POST["action"];
$remark=$_POST['remark'];
$stmt=$conn->prepare("UPDATE booking SET booking_status=?, remark=? WHERE id=?");
$stmt->bind_param("ssi",$update_status,$remark,$booking_id);
if($stmt->execute()) {
    echo "Remark is send and Booking status changed";
}
$stmt->close();

// notification for tw booking when status is changed by admin
$booking_id=$_POST["booking_id"];
$stmt=$conn->prepare("SELECT * FROM booking WHERE id=?");
$stmt->bind_param("i",$booking_id);
$stmt->execute();
$result=$stmt->get_result();
$booking=$result->fetch_assoc();
$user_id=$booking['user_id'];
$msg = "Your vehicle request for " . $booking['bike_name'] . " has been " . $booking['booking_status']."!";

date_default_timezone_set("Asia/Kolkata");
$msg_time = date("Y-m-d H:i:s");

$sql = "INSERT INTO notifications (user_id,message,created_at) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id,$msg,$msg_time);
$stmt->execute();
$stmt->close();

?>