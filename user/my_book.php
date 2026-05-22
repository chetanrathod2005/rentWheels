 <h2>Your Booking Details</h2>

<?php
$user_id = $_SESSION['user_id'];

$query = "
SELECT
    bike_name AS vehicle_name,
    bike_rent AS vehicle_rent,
    book_from,
    book_to,
    booking_status,

    CASE
        WHEN booking_status='Pending'
        AND CURDATE() > book_to THEN 'Expired'

        WHEN booking_status='Approved'
        AND CURDATE() < book_from THEN 'Upcoming'

        WHEN booking_status='Approved'
        AND CURDATE() BETWEEN book_from AND book_to THEN 'Ongoing'

        WHEN booking_status='Approved'
        AND CURDATE() > book_to THEN 'Completed'

        ELSE booking_status
    END AS progress_status,

    remark

FROM booking
WHERE user_id=?

UNION ALL

SELECT
    car_name AS vehicle_name,
    car_rent AS vehicle_rent,
    book_from,
    book_to,
    booking_status,

    CASE
        WHEN booking_status='Pending'
        AND CURDATE() > book_to THEN 'Expired'

        WHEN booking_status='Approved'
        AND CURDATE() < book_from THEN 'Upcoming'

        WHEN booking_status='Approved'
        AND CURDATE() BETWEEN book_from AND book_to THEN 'Ongoing'

        WHEN booking_status='Approved'
        AND CURDATE() > book_to THEN 'Completed'

        ELSE booking_status
    END AS progress_status,

    remark

FROM fw_booking
WHERE user_id=?
";

$stmt = $conn->prepare($query);

$stmt->bind_param("ii", $user_id, $user_id);

$stmt->execute();

$result = $stmt->get_result();
?>

<?php
if ($result->num_rows > 0) {

    $hasApproved = false;

    echo "
    <div class='table_container'>
    <table border='1'>

    <tr>
        <th>No</th>
        <th>Vehicle Name</th>
        <th>Vehicle Rent</th>
        <th>Book From</th>
        <th>Book To</th>
        <th>Total Days</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Progress</th>
        <th>Remark</th>
    </tr>
    ";

    $count = 1;

    while ($rides = $result->fetch_assoc()) {

        if ($rides['booking_status'] == 'Approved') {
            $hasApproved = true;
        }

        $progress = $rides['progress_status'];

        $class = "";

        if ($progress == "Ongoing") {
            $class = 'progress_ongoing';

        } elseif ($progress == "Completed") {
            $class = 'progress_completed';

        } elseif ($progress == 'Pending') {
            $class = 'progress_pending';

        } elseif ($progress == 'Rejected') {
            $class = 'progress_rejected';

        } elseif ($progress == 'Upcoming') {
            $class = 'progress_upcoming';

        } elseif ($progress == 'Expired') {
            $class = 'progress_expired';

        } else {
            $class = 'progress_unknown';
        }

        $from = new DateTime($rides['book_from']);
        $to = new DateTime($rides['book_to']);

        $diff = $from->diff($to);

        $total_days = $diff->days + 1;

        $total_price = $rides["vehicle_rent"] * $total_days;

        echo "
        <tr>
            <td>{$count}</td>
            <td>{$rides['vehicle_name']}</td>
            <td>{$rides['vehicle_rent']}</td>
            <td>{$rides['book_from']}</td>
            <td>{$rides['book_to']}</td>
            <td>$total_days</td>
            <td>$total_price</td>
            <td>{$rides['booking_status']}</td>
            <td><span class='$class'>$progress</span></td>
            <td>{$rides['remark']}</td>
        </tr>
        ";

        $count++;
    }

    echo "</table></div>";

    if ($hasApproved) {

        echo "
        <h3 class='print_head'>Print Your Invoice:</h3>

        <button class='main_print_btn'
        onclick='invoice_modal($user_id)'>
        Print
        </button>
        ";
    }

} else {

    echo "
    <div class='no-booking-message'>

        <p>
            Not booked any ride yet <br>
            Go to the available vehicle page and find your bike or car to enjoy your ride 😊
        </p>

        <div class='action-buttons'>

            <div class='available-bike'>
                <a href='dashboard.php?page=available_tw'>
                    <i class='ri-bike-line'></i>
                    Available Bikes
                </a>
            </div>

            <div class='available-car'>
                <a href='dashboard.php?page=available_fw'>
                    <i class='ri-car-line'></i>
                    Available Cars
                </a>
            </div>

        </div>

    </div>
    ";
}
?>

<div id="invoice_modal">

    <div class="invoice_content">

        <div id="bill_data"></div>

        <div class="print-btn">

            <button class="print_btn"
            onclick="window.print()">
            Print
            </button>

            <button class="cancel_print_btn"
            onclick="cancel_print()">
            Cancel
            </button>

        </div>

    </div>

</div>

<script>

function invoice_modal(user_id) {

    fetch("invoice.php?user_id=" + user_id)

    .then(res => res.text())

    .then(data => {

        document.getElementById("bill_data").innerHTML = data;

        document.getElementById("invoice_modal").style.display = "flex";
    });
}

function cancel_print() {

    document.getElementById("invoice_modal").style.display = "none";
}

</script>