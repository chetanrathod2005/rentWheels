<h1 style="text-align:center; margin-top: 30px;">Available Cars</h1>

<?php
include "../db.php";
$stmt = $conn->prepare("SELECT * FROM four_wheeler");
$stmt->execute();
$result = $stmt->get_result();
?>
  

<div class="two_wheeler">

<?php
if($result->num_rows > 0) {
    while($cars = $result->fetch_assoc()) {

echo "
<div class='bike-card'>
    <div class='image-slider-container'>
        <div class='image-slider'>
            <img src='../assets/images/cars/{$cars['img1']}' class='slide active' alt=''>
            <img src='../assets/images/cars/{$cars['img2']}' class='slide' alt=''>
            <img src='../assets/images/cars/{$cars['img3']}' class='slide' alt=''>
            <img src='../assets/images/cars/{$cars['img4']}' class='slide' alt=''>
            <!-- Add more images as needed -->
        </div>
        <div class='slider-dots'></div>
    </div>
   
    <div class='bike-details'>
        <span class='brand-badge'>{$cars['brand']}</span>
        <h3>{$cars['car_name']}</h3>
        
        <div class='specs-grid'>
            <p><strong>Seating Capacity:</strong> {$cars['seat_capacity']}</p>
            <p><strong>Fuel:</strong> {$cars['fuel_type']}</p>
        </div>
        
        <p class='price'>{$cars['rent']}<span>₹/day</span></p>
        <p class='about'>{$cars['description']}</p>

        <button onclick='bookRide({$cars['id']})' class='bike-btn'>Book Now</button>
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
 <script src="../assets/js/available_fw.js"></script> 
