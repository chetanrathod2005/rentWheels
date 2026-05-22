<?php
include '../../db.php';
$contact_id=$_GET['id'];
$stmt=$conn->prepare("SELECT * FROM contact WHERE id=?");
$stmt->bind_param("i",$contact_id);
$stmt->execute();
$result=$stmt->get_result();
$inquiry=$result->fetch_assoc();
?>

<div class="inquiry_info" >
<form method="post" id="inquiry_data" >
    <h4>This mail is send by <?php echo htmlspecialchars($inquiry['name'])?></h4>
    <p>Sender Maid Id: <strong><?php echo htmlspecialchars($inquiry['email']) ?></strong></p>
    <p>Inquiry Type: <strong><?php echo htmlspecialchars($inquiry['inquiry_type'])?></strong></p>
    <p>Message: <?php echo htmlspecialchars($inquiry['message'])?>
    <p>Send Time: <?php echo htmlspecialchars($inquiry['send_at'])?></p>

    <input type="hidden" id="contact_id" name="contact_id" value="<?php echo $inquiry['id']?>">
    <label for="reply_msg">Send Reply</label>
    <textarea rows="5" cols="100" id="reply_msg" name="reply_msg" placeholder="Send Reply" required></textarea>
    <input type="hidden" name="send_reply" id="send_reply">
    <button name="send_reply"  >Send Reply</button>
    <button type="button" onclick="cancel_reply()">Cancel</button>
    <p>Note:Send Mail take some time so don't click multiple time on send reply button</p>
</form>
</div>

