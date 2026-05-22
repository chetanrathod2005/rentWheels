<?php
include "../../../db.php";
$booking_id=$_GET['id'];

?>
<form method="post" action="action.php" id="action_data">
        <h2>Take Booking Action </h2>
                <input type="hidden" id="booking_id" name="booking_id"
                value="<?php echo $booking_id;?>">
                <label for="action">Take Action</label>
                <select id="action" name="action">
                <option value="Pending">Pending</option> 
                <option value="Approved">Approved</option> 
                <option value="Rejected">Rejected</option> 
                <option value="NA">NA</option> 
                </select>
                
                <label for="remark">Remark</label>
                <textarea id="remark" name="remark" rows="5" placeholder="Write Remark"></textarea>
                <button type="submit" class="confirm_btn">confirm</button>
                <button type="button" class="cancel_btn"
                onclick="cancelAction()">cancel</button>
</form>