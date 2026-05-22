<?php
include '../../db.php';
$brand_id=$_GET['id'];
$stmt=$conn->prepare("SELECT * FROM brand WHERE id=?");
$stmt->bind_param("i",$brand_id);
$stmt->execute();
$result=$stmt->get_result();
$brand=$result->fetch_assoc();
?>
<div class="update_modal">
 <h2>Update Brand</h2>   
<form method="post" enctype="multipart/form-data" id="update_data">
    <input type="hidden" name="brand_id" id="brand_id" value="<?php echo $brand['id']?>">
    <label for="brand_name">Name</label>
    <input type="text" name="brand_name" id="brand_name" value="<?php echo $brand['brand_name']?> required">
   
    <label for="country_name">Country</label>
    <input type="text" name="country_name" id="country_name" value="<?php echo $brand['country_name']?>" required>
   
    <p>Current Logo</p>
    <img src="../assets/images/brand_logo/<?php echo $brand['brand_logo']?>" width="120px"; height="70px">
    <input type="hidden" name="old_logo" value="<?php echo $brand['brand_logo'];?>">
    <label for="brand_logo">Change Logo</label>
    <input type="file" name="brand_logo" id="brand_logo" >
    <input type="hidden" name="update_brand">
    <div class="btns">
    <button name="update_brand" class="update_btn" type="submit" >Update</button>
    <button class="cancel_button" type="button" onclick="close_update()">Cancel</button>
    </div>
    
</form>
</div>