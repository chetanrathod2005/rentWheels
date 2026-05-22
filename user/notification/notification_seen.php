<?php
include "../../db.php";
session_start();
$user_id=$_SESSION['user_id'];
$stmt=$conn->prepare("UPDATE notifications SET is_read=1 WHERE user_id=? AND is_read=0 ");
$stmt->bind_param("i",$user_id);
$stmt->execute();
echo json_encode(["status"=>"success"]);
?>