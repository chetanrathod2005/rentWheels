<?php
include "../db.php";
$user_id = $_GET['user_id'];

$stmt = $conn->prepare("
    SELECT 
        u.name,
        u.email,
        u.mobile,
        b.bike_name AS vehicle_name,
        b.bike_rent AS vehicle_rent,
        b.book_from,
        b.book_to,
        b.booking_status,
        b.book_time,
        b.license,
        b.remark
    FROM booking b
    JOIN users u ON b.user_id = u.id
    WHERE b.user_id=? AND b.booking_status='Approved'

    UNION ALL

    SELECT 
        u.name,
        u.email,
        u.mobile,
        f.car_name AS vehicle_name,
        f.car_rent AS vehicle_rent,
        f.book_from,
        f.book_to,
        f.booking_status,
        f.book_time,
        f.license,
        f.remark
    FROM fw_booking f
    JOIN users u ON f.user_id = u.id
    WHERE f.user_id=? AND f.booking_status='Approved'
");

$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php
if($result->num_rows > 0) {

    $grand_total = 0;
?>

<div class="invoice-box" id="invoice">

    <div class="header">
        <img src="../assets/images/hero_img/logo.png">
        <h2>Rent Wheels</h2>
        <p>Date: <?php echo date("Y-m-d"); ?></p>
        
    </div>

    <?php
    // Fetch first row for customer name
    $first = $result->fetch_assoc();
    ?>
     
    <p>Customer Name: <?php echo $first['name']; ?></p>
    <p>Email Id:<?php echo $first['email']; ?></p>
    <p>Mobile Number: <?php echo $first['mobile']; ?></p>
    <p>Licence Number: <?php echo $first['license']; ?></p>
    
    <table class="invoice_table">
        <tr>
            <th>No</th>
            <th>Vehicle</th>
            <th>Rent/Day</th>
            <th>From</th>
            <th>To</th>
            <th>Booked Time</th>
            <th>Days</th>
            <th>Total</th>
        </tr>

        <?php
        $count = 1;

        // process first row
        do {
            $from = new DateTime($first['book_from']);
            $to = new DateTime($first['book_to']);
            $days = $from->diff($to)->days + 1;
            $total = $days * $first['vehicle_rent'];
            $grand_total += $total;
        ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $first['vehicle_name']; ?></td>
                <td>₹<?php echo $first['vehicle_rent']; ?></td>
                <td><?php echo $first['book_from']; ?></td>
                <td><?php echo $first['book_to']; ?></td>
                <td><?php echo $first['book_time']; ?></td>
                <td><?php echo $days; ?></td>
                <td>₹<?php echo $total; ?></td>
            </tr>
        <?php
        } while($first = $result->fetch_assoc());
        ?>
    </table>

    <div class="total">
        Grand Total: ₹<?php echo $grand_total; ?>
    </div>

    <p style="text-align:center;margin-top:20px;">
        Thank you for choosing our service 😊
    </p>

</div>

<?php
}
?>