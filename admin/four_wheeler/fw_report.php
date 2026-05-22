<h2>Four Wheeler Booking Report</h2>

<div class="serach_date">

<form method="post">

    <label for="book_from">Book From Date</label>

    <input
    type="date"
    name="book_from"
    id="book_from"
    value="<?php echo $_POST['book_from'] ?? '' ?>"
    required>

    <label for="book_to">Book To Date</label>

    <input
    type="date"
    name="book_to"
    id="book_to"
    value="<?php echo $_POST['book_to'] ?? '' ?>"
    required>

    <label for="booking_status">Booking Status</label>

    <select name="booking_status" id="booking_status">

        <option value="All">All</option>
        <option value="Approved">Approved</option>
        <option value="Pending">Pending</option>
        <option value="Rejected">Rejected</option>

    </select>

    <button type="submit" name="search">
        Search
    </button>

</form>

</div>

<div class="table_container">

<?php

include "../db.php";

if(isset($_POST['search'])) {

    $book_from = $_POST["book_from"];

    $book_to = $_POST["book_to"];

    $booking_status = $_POST['booking_status'];

    /* ---------- QUERY ---------- */

    $query = "

    SELECT 

        u.name,
        b.car_name,
        b.car_rent,
        b.book_from,
        b.book_to,
        b.booking_status,
        b.book_time,

        CASE

            WHEN b.booking_status='Pending'
            AND CURDATE() > b.book_to
            THEN 'Expired'

            WHEN b.booking_status='Approved'
            AND CURDATE() < b.book_from
            THEN 'Upcoming'

            WHEN b.booking_status='Approved'
            AND CURDATE() BETWEEN b.book_from
            AND b.book_to
            THEN 'Ongoing'

            WHEN b.booking_status='Approved'
            AND CURDATE() > b.book_to
            THEN 'Completed'

            ELSE b.booking_status

        END AS progress_status

    FROM users u

    JOIN fw_booking b
    ON u.id = b.user_id

    WHERE b.book_from >= ?
    AND b.book_to <= ?
    ";

    /* ---------- STATUS FILTER ---------- */

    if($booking_status != "All") {

        $query .= " AND b.booking_status=?";

        $stmt = $conn->prepare($query);

        $stmt->bind_param(
            "sss",
            $book_from,
            $book_to,
            $booking_status
        );

    } else {

        $stmt = $conn->prepare($query);

        $stmt->bind_param(
            "ss",
            $book_from,
            $book_to
        );
    }

    $stmt->execute();

    $result = $stmt->get_result();

    /* ---------- SHOW DATA ---------- */

    if($result->num_rows > 0) {

        echo "

        <table border='1' class='search_table'>

        <tr>

            <th>Sr.No</th>
            <th>Customer Name</th>
            <th>Car Name</th>
            <th>Rent</th>
            <th>Status</th>
            <th>Book From</th>
            <th>Book To</th>
            <th>Booking Time</th>

        </tr>
        ";

        $count = 1;

        $revenue = 0;

        while($search = $result->fetch_assoc()) {

            $from = new DateTime($search['book_from']);

            $to = new DateTime($search['book_to']);

            $diff = $from->diff($to);

            $total_days = $diff->days + 1;

            $total_price =
            $total_days * $search['car_rent'];

            /* revenue only for completed */

            if($search['progress_status'] == 'Completed') {

                $revenue += $total_price;
            }

            echo "

            <tr>

                <td>$count</td>

                <td>{$search['name']}</td>

                <td>{$search['car_name']}</td>

                <td>{$search['car_rent']}</td>

                <td>{$search['progress_status']}</td>

                <td>{$search['book_from']}</td>

                <td>{$search['book_to']}</td>

                <td>{$search['book_time']}</td>

            </tr>
            ";

            $count++;
        }

        echo "</table>";

        echo "

        <div class='revenue_msg'>

        Total Revenue from date
        ".$_POST['book_from']."

        to date
        ".$_POST['book_to']."

        is

        <strong>$revenue</strong>

        <br><br>

        Note:
        Total revenue is calculated only for
        completed rides.

        </div>
        ";

    } else {

        echo "

        <h3 style='text-align:center; margin-top:20px;'>

        No data found

        </h3>
        ";
    }
}

?>

</div>

<script>

let bookFrom = document.getElementById("book_from");

let bookTo = document.getElementById("book_to");

/* current date */

let today =
new Date().toISOString().split("T")[0];

/* max date */

bookFrom.max = today;

bookTo.max = today;

/* validate */

bookFrom.addEventListener("change", function () {

    bookTo.min = this.value;

    if(bookTo.value < this.value) {

        bookTo.value = "";
    }

});

</script>