 <div class="admin-container">

<?php
include "../db.php";

/* ---------- FUNCTIONS ---------- */

function getCount($conn, $table)
{
    $count = 0;

    $stmt = $conn->prepare("SELECT COUNT(*) FROM $table");

    $stmt->execute();

    $stmt->bind_result($count);

    $stmt->fetch();

    $stmt->close();

    return $count;
}

/* ---------- COMPLETED RIDES ---------- */

function getCompletedCount($conn, $table)
{
    $count = 0;

    $stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM $table
        WHERE booking_status='Approved'
        AND CURDATE() > book_to
    ");

    $stmt->execute();

    $stmt->bind_result($count);

    $stmt->fetch();

    $stmt->close();

    return $count;
}

/* ---------- ONGOING RIDES ---------- */

function getOngoingCount($conn, $table)
{
    $count = 0;

    $stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM $table
        WHERE booking_status='Approved'
        AND CURDATE() BETWEEN book_from AND book_to
    ");

    $stmt->execute();

    $stmt->bind_result($count);

    $stmt->fetch();

    $stmt->close();

    return $count;
}

/* ---------- REVENUE ---------- */

function getRevenue($conn, $table, $rent_column)
{
    $stmt = $conn->prepare("
        SELECT
            $rent_column,
            book_from,
            book_to

        FROM $table

        WHERE booking_status='Approved'
        AND CURDATE() > book_to
    ");

    $stmt->execute();

    $result = $stmt->get_result();

    $total_revenue = 0;

    while ($row = $result->fetch_assoc()) {

        $book_from = new DateTime($row['book_from']);

        $book_to = new DateTime($row['book_to']);

        $days = $book_from->diff($book_to)->days + 1;

        $total_revenue += $days * $row[$rent_column];
    }

    $stmt->close();

    return $total_revenue;
}

/* ---------- DATA ---------- */

$tw_revenue = getRevenue($conn, "booking", "bike_rent");
$fw_revenue = getRevenue($conn, "fw_booking", "car_rent");
$tw_completed = getCompletedCount($conn, "booking");
$fw_completed = getCompletedCount($conn, "fw_booking");
$tw_ongoing = getOngoingCount($conn, "booking");
$fw_ongoing = getOngoingCount($conn, "fw_booking");

$total_users = getCount($conn, "users");

$total_brands = getCount($conn, "brand");

$total_tw = getCount($conn, "two_wheeler");

$total_fw = getCount($conn, "four_wheeler");

$total_tw_booking = getCount($conn, "booking");

$total_fw_booking = getCount($conn, "fw_booking");

?>

<section>

    <h3 class="section-title">Our Progress</h3>

    <div class="stats-grid">

        <div class="card glass blue">

            <h3>Revenue: Two Wheeler</h3>

            <div class="count">
                ₹<?= number_format($tw_revenue) ?>
            </div>

            <i class="ri-money-dollar-circle-line icon-bg"></i>

        </div>

        <div class="card glass green">

            <h3>Revenue: Four Wheeler</h3>

            <div class="count">
                ₹<?= number_format($fw_revenue) ?>
            </div>

            <i class="ri-bank-card-line icon-bg"></i>

        </div>

        <div class="card">

            <h3>Completed 2W Rides</h3>

            <div class="count">
                <?= $tw_completed ?>
            </div>

            <a href="dashboard.php?page=tw_booking" class="btn">
                View Booking
            </a>

        </div>

        <div class="card">

            <h3>Completed 4W Rides</h3>

            <div class="count">
                <?= $fw_completed ?>
            </div>

            <a href="dashboard.php?page=fw_booking" class="btn">
                View Booking
            </a>

        </div>

        <div class="card">

            <h3>Ongoing 2W Rides</h3>

            <div class="count">
                <?= $tw_ongoing ?>
            </div>

            <a href="dashboard.php?page=tw_booking" class="btn">
                View Booking
            </a>

        </div>

        <div class="card">

            <h3>Ongoing 4W Rides</h3>

            <div class="count">
                <?= $fw_ongoing ?>
            </div>

            <a href="dashboard.php?page=fw_booking" class="btn">
                View Booking
            </a>

        </div>

    </div>

</section>

<section>

    <h3 class="section-title">Admin Action</h3>

    <div class="action-grid">

        <div class="card action-card">

            <i class="ri-group-fill main-icon"></i>

            <div class="info">

                <h3>Registered Users</h3>

                <div class="count">
                    <?= $total_users ?>
                </div>

            </div>

            <a href="dashboard.php?page=registered_user">
                Manage <i class="ri-arrow-right-s-line"></i>
            </a>

        </div>

        <div class="card action-card">

            <i class="ri-remix-fill main-icon"></i>

            <div class="info">

                <h3>Available Brands</h3>

                <div class="count">
                    <?= $total_brands ?>
                </div>

            </div>

            <a href="dashboard.php?page=brand">
                Manage <i class="ri-arrow-right-s-line"></i>
            </a>

        </div>

        <div class="card action-card">

            <i class="ri-e-bike-fill main-icon"></i>

            <div class="info">

                <h3>Two Wheelers</h3>

                <div class="count">
                    <?= $total_tw ?>
                </div>

            </div>

            <a href="dashboard.php?page=manage_tw">
                Manage <i class="ri-arrow-right-s-line"></i>
            </a>

        </div>

        <div class="card action-card">

            <i class="ri-car-fill main-icon"></i>

            <div class="info">

                <h3>Four Wheelers</h3>

                <div class="count">
                    <?= $total_fw ?>
                </div>

            </div>

            <a href="dashboard.php?page=manage_fw">
                Manage <i class="ri-arrow-right-s-line"></i>
            </a>

        </div>

        <div class="card action-card">

            <i class="ri-e-bike-fill main-icon"></i>

            <div class="info">

                <h3>Two Wheelers Report</h3>

            </div>

            <a href="dashboard.php?page=tw_report">
                View <i class="ri-arrow-right-s-line"></i>
            </a>

        </div>

        <div class="card action-card">

            <i class="ri-car-fill main-icon"></i>

            <div class="info">

                <h3>Four Wheelers Report</h3>

            </div>

            <a href="dashboard.php?page=fw_report">
                View <i class="ri-arrow-right-s-line"></i>
            </a>

        </div>

    </div>

</section>

</div>