<h2 style="text-align: center; margin-top:10px">Manage Vehicle Details</h2>
<?php
if(isset($_SESSION['dlt_msg'])) {
    echo "<div class='session_msg'>{$_SESSION['dlt_msg']}</div>";
    unset($_SESSION['dlt_msg']);
}
?>
<?php

include '../db.php';
$stmt = $conn->prepare("SELECT * FROM four_wheeler");
$stmt->execute();
$result = $stmt->get_result();

?>
    <div class="table_container">
    <?php
    if ($result->num_rows > 0) {
        echo "
        <table border='1' class='main_table'>
            <tr>
                <th>Sr_No</th>
                <th>Car_Name</th>
                <th>Brand</th>
                <th>View_Details</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>";
            $count=1;
        while ($car=$result->fetch_assoc()) {
            echo "<tr>
                <td>{$count}</td>
                <td>{$car['car_name']}</td>
                <td>{$car['brand']}</td>
                <td><button class='view-btn' onclick='view_fw({$car['id']})'>
                View</button></td>
                <td><button class='update-btn' onclick='update_fw({$car['id']})'>
                Update</button></td>
                <td><button class='delete-btn' onclick='delete_fw({$car['id']})'>
                Delete</button></td>
                </tr>";
                $count++;
        }
        echo "</table>";
    } else {
        echo "NOT Enter Any vehicle Data";
    }
    ?>
    </div>
    
    <div id="update_model">
        <div class="tw_details">
            <div id="update_content">

            </div>
            </div>
        </div>
 
    <div id="view_model">
        <div class="view_details">
        <div id="view_content">
            <!-- The view_modle open here (view popup open) -->
        </div>
        <button class="cancel_btn" onclick="close_view_model()">close</button>
        </div>
    </div>

    <div id="delete_model">
        <div class="delete_popup">
             <p>Are You sure you want to delete this vehicle details?</p>
            <p>Once if You Delete this details then the details will delete permanently</p>
            <div class="dlt_btn">
        <button type="submit" name="delete" class="delete_button" onclick="final_delete()">Delete</button>
        <button type="button" class="cancel_button" onclick="close_delete_model()">Cancel</button>
        </div>
        </div>
     </div>

    <script src="../assets/js/manage_fw.js"></script>
