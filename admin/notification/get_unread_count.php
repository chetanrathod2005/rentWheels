<?php
include "../../db.php";
session_start();
$admin_id=$_SESSION['admin_id'];
$stmt=$conn->prepare("SELECT COUNT(*) AS total FROM notifications WHERE user_id=? AND is_read=0");
$stmt->bind_param("i",$admin_id);
$stmt->execute();
$result=$stmt->get_result();
$count=$result->fetch_assoc();
echo json_encode($count);
?>