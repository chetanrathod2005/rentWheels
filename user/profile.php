        <?php
        include '../db.php';
        $user_id=$_SESSION['user_id'];
        $stmt=$conn->prepare("SELECT * FROM users where id=?");
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result=$stmt->get_result();
        $user=$result->fetch_assoc();
        ?>
 
        <?php
        if(isset($_POST['update_profile'])) {
            $user_id=$_SESSION["user_id"];
            $name=trim($_POST['name']);
            $mobile=trim($_POST['mobile']);
             if(empty($name) ||  empty($mobile) ){
                $_SESSION['error_message']="All fields are required";
                header("location:dashboard.php?page=profile");
                exit();
            }
                            // MOBILE VALIDATION
                if(!preg_match("/^[0-9]{10}$/", $mobile)){
                    $_SESSION['error_message']="Invalid Mobile Number";
                    header("location:dashboard.php?page=profile");
                    exit();
                }
            $stmt=$conn->prepare("UPDATE users SET name=?,mobile=? where id=?");
            $stmt->bind_param("ssi",$name,$mobile,$user_id);
            if($stmt->execute()) {
                $_SESSION['message']= "profile updated successfully";
                 header("location:dashboard.php?page=profile");
                exit();
            } else {
                $_SESSION['error_message']="error".$stmt->error;
                header("location:dashboard.php?page=profile");
                exit();
            }
        }
    
        ?>
 <body>
    <form>
        <h2>Welcome <?php echo $user['name'];?></h2>
        <div class="profile_icon">
            <i class="ri-account-circle-fill"></i>
        </div>
        <?php
        if(isset($_SESSION['message'])) {
            echo "<div class='update_msg'>{$_SESSION['message']}</div>";
            unset($_SESSION['message']);
        }
        if(isset($_SESSION['error_message'])) {
            echo "<div class='error_msg'>{$_SESSION['error_message']}</div>";
            unset($_SESSION['error_message']);
        }
        ?>
        <div class="user_table">
        <table border="1">
            <tr><th>Name</th><td><?php echo $user['name'];?></td></tr>
            <tr><th>Email</th><td><?php echo $user['email'];?></td></tr>
            <tr><th>Mobile Number</th><td><?php echo $user['mobile'];?></td></tr>
            <tr><th>Password</th><td><?php echo "********";?></td></tr>
        </table>
        </div>
         <div class="update_profile">
            <button type="submit" onclick="update_profile()">Update Profile</button>
        </div>
    </form>
         
      <div id="update_modal">
        <div class="update_content">
         <form method="POST">
            <h4> Update your profile</h4>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $user['name']?>" required?>
            <label for="mobile">Mobile Number</label>
            <input type="tel" name="mobile" id="mobile" value="<?php echo $user['mobile']?>" required>
            <button type="submit" class="update_btn" name="update_profile">Update</button>
            <button type="button" class="cancel_btn" onclick="cancel_update()">Cancel</button>
         </form>
        </div>
      </div>
 </body>
 <script>
   function update_profile() {
    event.preventDefault();
    document.getElementById("update_modal").style.display="flex"
    }
    function cancel_update() {
        document.getElementById("update_modal").style.display="none";
    }
   
 </script>
