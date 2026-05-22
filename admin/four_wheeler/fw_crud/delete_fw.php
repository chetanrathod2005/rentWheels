 
 <?php
 include '../../../db.php';
 session_start();
 if(isset($_GET['delete_id'])) {
    $id=$_GET['delete_id'];
    $stmt=$conn->prepare("SELECT img1, img2, img3, img4
     from four_wheeler where id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $images=$result->fetch_assoc();
    $target_dir="../../../assets/images/cars/";
    if(!empty($images['img1']) && file_exists($target_dir.$images['img1'])) {
      unlink($target_dir.$images['img1']);
    }
    if(!empty($images['img2']) && file_exists($target_dir.$images['img2'])) {
      unlink($target_dir.$images['img2']);
    }
    if(!empty($images['img3']) && file_exists($target_dir.$images['img3'])) {
      unlink($target_dir.$images['img3']);
    }
    if(!empty($images['img4']) && file_exists($target_dir.$images['img4'])) {
      unlink($target_dir.$images['img4']);
    }
    
    $stmt=$conn->prepare("DELETE FROM four_wheeler where id=?");  
    $stmt->bind_param("i",$id);
    if($stmt->execute()) {
        $_SESSION['dlt_msg']= "details deleted successfully";
    }
    
    }
 ?>
