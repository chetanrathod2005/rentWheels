<h2 style="text-align: center;">Manage Vehicle Details</h2>

<?php

include '../db.php';
$stmt = $conn->prepare("SELECT * FROM two_wheeler");
$stmt->execute();
$result = $stmt->get_result();

?>
    <div class="table_container">
    <?php
    if ($result->num_rows > 0) {
        echo "
        <table border='1' >
            <tr>
                <th>Sr_No</th>
                <th>Bike_Name</th>
                <th>Brand</th>
                <th>View_Details</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>";
            $count=1;
        while ($bikes=$result->fetch_assoc()) {
            echo "<tr>
                <td>{$count}</td>
                <td>{$bikes['name']}</td>
                <td>{$bikes['brand']}</td>
                <td><button class='view-btn' onclick='view_tw({$bikes['id']})'>
                View</button></td>
                <td><button class='update-btn' onclick='update_tw({$bikes['id']})'>
                Update</button></td>
                <td><button class='delete-btn' onclick='delete_tw({$bikes['id']})'>
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
        <button class="cancel_btn" onclick="closemodel()">close</button>
        </div>
    </div>

    <div id="delete_model">
        <div class="delete_popup">
             <p>Are You sure you want to delete thise vehicle details?</p>
            <p>Once if You Delete this deletails then the detilas delete permanant</p>
            <div class="dlt_btn">
        <button type="submit" name="delete" class="delete_button" onclick="final_delete()">Delete</button>
        <button type="button" class="cancel_button" onclick="cancel_delete()">Cancel</button>
        </div>
        </div>
     </div>

    <script src="../assets/js/manage_tw.js"> </script>

