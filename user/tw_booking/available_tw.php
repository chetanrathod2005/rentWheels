<h1 style="text-align:center; margin-top: 30px;">Available Bikes</h1>

<?php
include "../db.php";
$stmt = $conn->prepare("SELECT * FROM two_wheeler");
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="two_wheeler">

<?php
if($result->num_rows > 0) {
    while($bikes = $result->fetch_assoc()) {

echo "
<div class='bike-card'>
    <div class='image-slider-container'>
        <div class='image-slider'>
            <img src='../assets/images/bikes/{$bikes['img1']}' class='slide active' alt=''>
            <img src='../assets/images/bikes/{$bikes['img2']}' class='slide' alt=''>
        </div>
        <div class='slider-dots'></div>
    </div>
   
    <div class='bike-details'>
        <span class='brand-badge'>{$bikes['brand']}</span>
        <h3>{$bikes['name']}</h3>
        
        <div class='specs-grid'>
            <p><strong>Seating Capacity:</strong> {$bikes['seat_capacity']}</p>
            <p><strong>Fuel:</strong> {$bikes['fuel_type']}</p>
        </div>
        
        <p class='price'>{$bikes['rent']}<span>₹/day</span></p>
        <p class='about'>{$bikes['description']}</p>

        <button onclick='bookRide({$bikes['id']})' class='bike-btn'>Book Now</button>
    </div>
</div>
";
    }
}
?>
</div>


<div id="book_model">
    <div class="booking_details">
   <div id="booking_content">
   
   </div>
    </div>
</div>
<script src="../assets/js/available_tw.js"></script>
