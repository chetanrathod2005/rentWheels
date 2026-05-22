<?php
    session_start();
    include '../../db.php';
   
    if(isset($_GET['delete_id'])) {
    $id=$_GET['delete_id'];
    $stmt=$conn->prepare("SELECT brand_logo
     FROM brand WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $image=$result->fetch_assoc();
    $target_dir="../../assets/images/brand_logo/";
   
    if(!empty($image['brand_logo']) && file_exists($target_dir.$image['brand_logo'])) {
    
      unlink($target_dir.$image['brand_logo']);
    }
    
    $stmt=$conn->prepare("DELETE FROM brand WHERE id=?");  
    $stmt->bind_param("i",$id);
    if($stmt->execute()) {
        $_SESSION['message']="Brand details deleted successfully";
    }
 }
 
?>