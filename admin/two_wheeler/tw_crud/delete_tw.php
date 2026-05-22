 
 <?php
 include '../../../db.php';
 if(isset($_GET['delete_id'])) {
    $id=$_GET['delete_id'];
    $stmt=$conn->prepare("SELECT img1, img2 FROM two_wheeler WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $images=$result->fetch_assoc();
    $target_dir="../../../assets/images/bikes/";
    if(!empty($images['img1']) && file_exists($target_dir.$images['img1'])) {
      unlink($target_dir.$images['img1']);
    }
    if(!empty($images['img2']) && file_exists($target_dir.$images['img2'])) {
      unlink($target_dir.$images['img2']);
    }
    
    $stmt=$conn->prepare("DELETE FROM two_wheeler where id=?");  
    $stmt->bind_param("i",$id);
    if($stmt->execute()) {
        echo "details deleted successfully";
    }
    
    }
 ?>
 

 
 


