<?php
include "../../../db.php";
$id=$_GET['id'];
$stmt=$conn->prepare("SELECT 
    b.id,
    u.name,
    u.email,
    u.mobile,
    b.bike_name,
    b.bike_rent,
    b.license,
    b.book_from,
    b.book_to,
    b.booking_status,
    b.book_time,
    b.document
    FROM users u
    JOIN booking b
    ON 
    u.id=b.user_id
    where b.id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result=$stmt->get_result();
    $customer=$result->fetch_assoc();
    $from=new DateTime($customer['book_from']);
    $to=new DateTime($customer['book_to']);
    $diff=$from->diff($to);
    $total_days=$diff->days+1;
    $total_price=$customer["bike_rent"]*$total_days;
    
?>
<table border="1" class="customer_details">
    <tr>
        <th>Account Holder Name</th><td><?php echo $customer['name']?></td>
    </tr>
    <tr>
        <th>Email</th><td><?php echo $customer['email']?></td>
    </tr>
    <tr>
        <th>Mobile</th><td><?php echo $customer['mobile']?></td>
    </tr>
    <tr>
        <th>License Number</th><td><?php echo $customer['license']?></td>
    </tr>
    <tr>
        <th>Bike Name</th><td><?php echo $customer['bike_name']?></td>
    </tr>
    <tr>
        <th>Document</th>
        <td>
        <a href="../assets/images/documents/<?php echo $customer['document']?>">
            <?php echo $customer['document']?>
        </a>
        </td>
    </tr>
    <tr>
        <th>Booking Status</th>
        <td><?php echo $customer['booking_status']?></td>
    </tr>
    <tr>
        <th>Bike Rent</th>
        <td><?php echo $customer['bike_rent']?></td>
    </tr>
    <tr>
        <th>Book From</th>
        <td><?php echo $customer['book_from']?></td>
    </tr>
    <tr>
        <th>Book To</th>
        <td><?php echo $customer['book_to']?></td>
    </tr>
    <tr>
        <th>Total Days</th>
        <td><?php echo $total_days?></td>
    </tr>
    <tr>
        <th>Total Amount</th>
        <td><?php echo $total_price?></td>
    </tr>
    <tr>
        <th>Booked Date</th>
        <td><?php echo $customer['book_time']?></td>
    </tr>
</table>