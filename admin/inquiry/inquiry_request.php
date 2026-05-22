<style>
   
</style>
<?php
if (isset($_SESSION['success_msg'])) {
    echo "<div class='success_msg'>{$_SESSION['success_msg']}</div>";
    unset($_SESSION['success_msg']);
}
if (isset($_SESSION['error_msg'])) {
    echo "<div class='error_msg'>{$_SESSION['error_msg']}</div>";
    unset($_SESSION['error_msg']);
}
?>
<h2>This are the mail that send by users for support </h2>
<div class="table_container">
<?php
include "../db.php";
if (isset($_SESSION['admin_id'])) {
    $stmt = $conn->prepare("SELECT * FROM contact");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        echo "<table border='1'>
        <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>User Type</th>
        <th>inquiry type</th>
        <th>Status</th>
        <th>Reply Message</th>
        <th>Reply</th>
        </tr>
        ";
        $count = 1;
        while ($contact = $result->fetch_assoc()) {
            echo "
        <tr>
        <td>$count</td>
        <td>{$contact['name']}</td>
        <td>{$contact['email']}</td> 
        <td>{$contact['user_type']}</td>
        <td>{$contact['inquiry_type']}</td>
        <td>{$contact['reply_status']}</td>
        <td>{$contact['reply_msg']}</td>
        <td><button onclick='open_reply_modal({$contact['id']})'>Reply</button></td>
        </tr>";
            $count++;
        }
        echo "</table>";
        echo "<p style='margin-top:10px';>Note: send reply may take some time for send mail  so wait for some time</p>";
    }
}

?>
</div>

<div id="reply_modal">
    <div class="reply_detail">
        <div id="reply_content">
        </div>
    </div>
</div>
<script>
    function open_reply_modal(id) {
        fetch("inquiry/inquiry_modal.php?id=" + id)
            .then(res => res.text())
            .then(data => {
                document.getElementById("reply_modal").style.display = "flex";
                document.getElementById("reply_content").innerHTML = data;

                const form = document.getElementById('inquiry_data');
                if (form) {
                    form.addEventListener("submit", function (e) {
                        e.preventDefault();
                        let formData = new FormData(form);
                        fetch("inquiry/send_reply.php", {
                            method: "POST",
                            body: formData
                        })
                            .then(res => res.text())
                            .then(data => {
                                location.reload();
                            })
                            .catch(error => {
                                console.log("Eroor:", error);
                            })
                    })
                }
            })
    }


    function cancel_reply() {
        document.getElementById("reply_modal").style.display = "none";
    }
</script>