<div class="dashboard-container">
  <div class="booking_details">
    <p class="section-header">Your Booking Requests Status</p>

    <div class="num_of_booking">

      <!-- Completed -->
      <div class="status-card approved">
        <i class="ri-checkbox-circle-line"></i>
        <h4>Completed Rides</h4>

        <div class="count">
          <?php
          include "../db.php";

          $user_id = $_SESSION['user_id'];

          $query = "
          SELECT COUNT(*) AS total_completed
          FROM (

            SELECT id
            FROM booking
            WHERE booking_status='Approved'
            AND CURDATE() > book_to
            AND user_id=?

            UNION ALL

            SELECT id
            FROM fw_booking
            WHERE booking_status='Approved'
            AND CURDATE() > book_to
            AND user_id=?

          ) AS combined
          ";

          $stmt = $conn->prepare($query);
          $stmt->bind_param("ii", $user_id, $user_id);
          $stmt->execute();

          $result = $stmt->get_result();
          $count = $result->fetch_assoc();

          echo $count['total_completed'];
          ?>
        </div>
      </div>

      <!-- Ongoing -->
      <div class="status-card ongoing">
        <i class="ri-donut-chart-line"></i>
        <h4>Ongoing Rides</h4>

        <div class="count">
          <?php

          $query = "
          SELECT COUNT(*) AS total_ongoing
          FROM (

            SELECT id
            FROM booking
            WHERE booking_status='Approved'
            AND CURDATE() BETWEEN book_from AND book_to
            AND user_id=?

            UNION ALL

            SELECT id
            FROM fw_booking
            WHERE booking_status='Approved'
            AND CURDATE() BETWEEN book_from AND book_to
            AND user_id=?

          ) AS combined
          ";

          $stmt = $conn->prepare($query);
          $stmt->bind_param("ii", $user_id, $user_id);
          $stmt->execute();

          $result = $stmt->get_result();
          $count = $result->fetch_assoc();

          echo $count['total_ongoing'];
          ?>
        </div>
      </div>

      <!-- Pending -->
      <div class="status-card pending">
        <i class="ri-time-line"></i>
        <h4>Pending/Expired Rides</h4>

        <div class="count">
          <?php

          $query = "
          SELECT COUNT(*) AS total_pending
          FROM (

            SELECT id
            FROM booking
            WHERE booking_status='Pending'
            AND user_id=?

            UNION ALL

            SELECT id
            FROM fw_booking
            WHERE booking_status='Pending'
            AND user_id=?

          ) AS combined
          ";

          $stmt = $conn->prepare($query);
          $stmt->bind_param("ii", $user_id, $user_id);
          $stmt->execute();

          $result = $stmt->get_result();
          $count = $result->fetch_assoc();

          echo $count['total_pending'];
          ?>
        </div>
      </div>

      <!-- Rejected -->
      <div class="status-card rejected">
        <i class="ri-close-circle-line"></i>
        <h4>Rejected Requests</h4>

        <div class="count">
          <?php

          $query = "
          SELECT COUNT(*) AS total_rejected
          FROM (

            SELECT id
            FROM booking
            WHERE booking_status='Rejected'
            AND user_id=?

            UNION ALL

            SELECT id
            FROM fw_booking
            WHERE booking_status='Rejected'
            AND user_id=?

          ) AS combined
          ";

          $stmt = $conn->prepare($query);
          $stmt->bind_param("ii", $user_id, $user_id);
          $stmt->execute();

          $result = $stmt->get_result();
          $count = $result->fetch_assoc();

          echo $count['total_rejected'];
          ?>
        </div>
      </div>

    </div>

    <div class="explore_booking">
      <a href="dashboard.php?page=my_booking" class="btn-main">
        View Full Booking Details
      </a>
    </div>
  </div>

  <div class="action-buttons">

    <div class="availabe_bike">
      <a href="dashboard.php?page=available_tw">
        <i class="ri-bike-line"></i> Available Bikes
      </a>
    </div>

    <div class="availabe_car">
      <a href="dashboard.php?page=available_fw">
        <i class="ri-car-line"></i> Available Cars
      </a>
    </div>

  </div>
</div>