<?php
include '../db.php';

$email=$_SESSION['admin_email'];
$stmt=$conn->prepare("SELECT * FROM users");
$stmt->execute();
$result=$stmt->get_result();
?>
    <div class="table_container">
   <h2>Registered User</h2>
    <table border="1" id="user_table">
      <thead>
        <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Registered Time</th>
    </tr>
    </thead>
    <tbody>
    <?php
    
    if($result->num_rows>0) {
      $count=1;
     while($user=$result->fetch_assoc()) {
        echo "
     <tr><td>$count</td>
     <td>{$user['name']}</td>
     <td>{$user['email']}</td>
     <td>{$user['mobile']}</td>
     <td>{$user['created_at']}</td></tr>";
     $count++;
      }
    }
    ?>
    </tbody>
    </table>
   </div>