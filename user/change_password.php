<style>
    h2 {
        text-align: center;
        margin-top: 30px;
    }
    .change_password {
    width: 350px;
    /* margin: 60px auto; */
    margin: 20px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.change_password form {
    display: flex;
    flex-direction: column;
}

.change_password label {
    margin-top: 12px;
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.change_password input {
    margin-top: 6px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: border 0.3s ease, box-shadow 0.3s ease;
}

.change_password input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}

.change_password button {
    margin-top: 20px;
    background-color: #3b5fc4;
    color: #fff;
    border-color: transparent;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    padding: 10px 10px;
    font-weight: 600;
    transition: 0.3s;
}

.change_password button:hover {
    transform: scale(1.05);
    background-color: transparent;
    color: #2c4a9a;
    border: 2px solid #2c4a9a;
}
.err_msg {
    margin-top:30px ;
    text-align: center;
    color: red;
}
.success_msg {
    margin-top: 30px;
    text-align: center;
    color: green;
}
</style>

<?php
include "../db.php";
if(isset($_POST['change_password'])) {
$user_id=$_SESSION['user_id'];
$stmt=$conn->prepare("SELECT password FROM users where id=?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result=$stmt->get_result();
$crt_password=$result->fetch_assoc();

$crt_pass=$_POST['crt_pass'];
$new_pass=$_POST['new_pass'];
$confirm_pass=$_POST['confirm_pass'];

if(!password_verify($crt_pass,$crt_password['password'])) {
    $_SESSION['error_message']="Enter correct current password";
    
} elseif(strlen($new_pass)<8) {
    $_SESSION['error_message']="Password must be at least 8 character long";
} elseif(password_verify($new_pass,$crt_password['password'])) {
    $_SESSION['error_message']="New Password should not match with previous password";
} elseif($new_pass!=$confirm_pass) {
    $_SESSION['error_message']="New password and confirm password is not match";
} else {
    $hash_password=password_hash($new_pass,PASSWORD_DEFAULT);
    $stmt=$conn->prepare("UPDATE users SET password=? where id=?");
    $stmt->bind_param("si",$hash_password,$user_id);
    if($stmt->execute()) {
        $_SESSION['success_message']="Password changed successfully";
    } else {
        echo "Error".$stmt->error;
    }
    $stmt->close();
}
}
?>
<h2>Change Your Password</h2>
<?php
if(isset($_SESSION['error_message'])) {
    echo "<div class='err_msg'>{$_SESSION['error_message']}</div>";
    unset($_SESSION['error_message']);
}
if(isset($_SESSION['success_message'])) {
    echo "<div class='success_msg'>{$_SESSION['success_message']}</div>";
    unset($_SESSION['success_message']);
} 
?>
<div class="change_password">
    <form method="post">
        <label for="crt_pass">Enter Current Password</label>
        <input type="password" name="crt_pass" id="crt_pass" 
        placeholder="Enter Your Old Password" required>

        <label for="new_pass">Enter New Password</label>
        <input type="password" name="new_pass" id="new_pass"
        placeholder="Enter New Password" required>

        <label for="confirm_pass">Confirm New  Password</label>
        <input type="password" name="confirm_pass" id="confirm_pass"
        placeholder="Enter Confirm Password" required>

        <button type="submit" name="change_password">Change Password</button>
    </form>
</div>