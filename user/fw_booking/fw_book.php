<?php
include '../../db.php';
$id=$_GET['id'];
$stmt=$conn->prepare("SELECT * FROM four_wheeler where id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();
$car=$result->fetch_assoc();

?>

<div class="confirm_book" action="fw_book.php">
    <form method="post" id="booking_data" enctype="multipart/form-data">
        <h3>Fill Your Details And Confirm Booking</h3>
        <label for="name">Vehicle Name</label>
        <input type="text" name="car_name" id="name"
         value="<?php echo $car['car_name']?>" readonly>

         <label for="rent">Rent/Day</label>
         <input type="number" name="rent" id="rent" 
          value="<?php echo $car['rent']?>" readonly>
         
         <label for="license">Enter License Number</label>
         <input type="text" name="license" id="license"
         style="text-transform:uppercase;"
         placeholder="EX: GJ04 20260001234" required>

         <label for="date_from">Booking From:</label>
         <input type="date" name="date_from" id="date_from" 
         min="<?php echo date("Y-m-d");?>" required>

         <label for="date_to">Booking To:</label>
         <input type="date" name="date_to" id="date_to"
          max="<?php echo date("Y-m-d",strtotime("+2 months"))?>"
          min="<?php echo date("Y-m-d")?>" required>

         <label for="document">Upload Driving Licence Photo</label>
         <input type="file" name="document" id="document" required>
         <span>Allow format pdf,jpg,png and size should not more than 1 MB</span>

         <button type="submit">Confirm Book</button>

         <button type="button" onclick="cancel_book()">
         Cancel </button>

    </form>
</div>
