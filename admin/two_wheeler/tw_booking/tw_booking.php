 <link rel="stylesheet" href="../assets/css/admin_css/tw_booking.css">

<h2>Two Wheeler Booking Request</h2>

<?php

include '../db.php';

/* ---------- QUERY ---------- */

$query = "

SELECT 
    b.id,
    u.name,
    u.email,
    u.mobile,
    b.bike_name,
    b.bike_rent,
    b.book_time,
    b.booking_status,

    CASE

        WHEN b.booking_status='Pending'
        AND CURDATE() > b.book_to
        THEN 'Expired'

        WHEN b.booking_status='Approved'
        AND CURDATE() < b.book_from
        THEN 'Upcoming'

        WHEN b.booking_status='Approved'
        AND CURDATE() BETWEEN b.book_from AND b.book_to
        THEN 'Ongoing'

        WHEN b.booking_status='Approved'
        AND CURDATE() > b.book_to
        THEN 'Completed'

        ELSE b.booking_status

    END AS progress_status

FROM users u

JOIN booking b
ON u.id = b.user_id

ORDER BY b.book_time DESC
";

$stmt = $conn->prepare($query);

$stmt->execute();

$result = $stmt->get_result();

?>

<div class="table_container">

<?php

if ($result->num_rows > 0) {

    echo "

    <table border='1' class='list_table' id='tw_booking'>

    <thead>

    <tr>

        <th>No.</th>
        <th>UserName</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Bike</th>
        <th>Status</th>
        <th>Progress</th>
        <th>Book Time</th>
        <th>View More</th>
        <th>Action</th>

    </tr>

    </thead>

    <tbody>
    ";

    $count = 1;

    while ($booking = $result->fetch_assoc()) {

        $progress = $booking['progress_status'];

        $class = "";

        if ($progress == "Ongoing") {

            $class = 'progress_ongoing';

        } elseif ($progress == "Completed") {

            $class = 'progress_completed';

        } elseif ($progress == "Pending") {

            $class = 'progress_pending';

        } elseif ($progress == "Rejected") {

            $class = 'progress_rejected';

        } elseif ($progress == "Upcoming") {

            $class = 'progress_upcoming';

        } elseif ($progress == "Expired") {

            $class = 'progress_expired';

        } else {

            $class = 'progress_unknown';
        }

        echo "

        <tr>

            <td>$count</td>

            <td>{$booking['name']}</td>

            <td>{$booking['email']}</td>

            <td>{$booking['mobile']}</td>

            <td>{$booking['bike_name']}</td>

            <td>{$booking['booking_status']}</td>

            <td>
                <span class='$class'>
                    $progress
                </span>
            </td>

            <td>{$booking['book_time']}</td>

            <td>
                <button onclick='viewMore({$booking['id']})'>
                    View
                </button>
            </td>

            <td class='action_btn'>
                <button onclick='action({$booking['id']})'>
                    Take Action
                </button>
            </td>

        </tr>
        ";

        $count++;
    }

    echo "
    </tbody>
    </table>
    ";

} else {

    echo "NOT any request for booking";
}

?>

</div>

<div id="action_model">

    <div class="action_details">

        <div id="action_content"></div>

    </div>

</div>

<div id="view_more_model">

    <div class="request_details">

        <h2>Details of user who request for vehicle</h2>

        <div id="view_more_content"></div>

        <button class="close_btn"
        onclick="close_view_more()">
        Close
        </button>

    </div>

</div>

<script>

function action(id) {

    fetch("two_wheeler/tw_booking/action_tw.php?id=" + id)

    .then(res => res.text())

    .then(data => {

        document.getElementById("action_model").style.display = "flex";

        document.getElementById("action_content").innerHTML = data;
    });
}

document.addEventListener("submit", function (e) {

    if (e.target && e.target.id == "action_data") {

        e.preventDefault();

        let formData = new FormData(e.target);

        fetch("two_wheeler/tw_booking/update_booking.php", {

            method: "POST",

            body: formData

        })

        .then(res => res.text())

        .then(data => {

            alert(data);

            location.reload();
        });
    }
});

function cancelAction() {

    document.getElementById("action_model").style.display = "none";
}

function viewMore(id) {

    fetch("two_wheeler/tw_booking/booking_details.php?id=" + id)

    .then(res => res.text())

    .then(data => {

        document.getElementById("view_more_model").style.display = "flex";

        document.getElementById("view_more_content").innerHTML = data;
    });
}

function close_view_more() {

    document.getElementById("view_more_model").style.display = "none";
}

</script>