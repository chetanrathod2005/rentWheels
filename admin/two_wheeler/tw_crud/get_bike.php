 <?php 
 include '../../../db.php';
 $id=$_GET['id'];
 $stmt=$conn->prepare("SELECT * FROM two_wheeler where id=?");
 $stmt->bind_param("i",$id);
 $stmt->execute();
 $result=$stmt->get_result();
 $bike=$result->fetch_assoc();
 ?>
 <h3><?php echo $bike['name']?> Details</h3>
 <table border="1" class="main_table">
    <tr>
        <th>Bike_Name</th>
        <td><?php echo $bike['name']?></td>
    </tr>
    <tr>
        <th>Brand</th>
        <td><?php echo $bike['brand']?></td>
    </tr>
    <tr>
        <th>vehicle_type</th>
        <td><?php echo $bike['vehicle_type']?></td>
    </tr>
    <tr>
        <th>Model_Year</th>
        <td><?php echo $bike['model_year']?></td>
    </tr>
    <tr>
        <th>Seat_Capacity</th>
        <td><?php echo $bike['seat_capacity']?></td>
    </tr>
    <tr>
        <th>rent</th>
        <td><?php echo $bike['rent']?></td>
    </tr>
    <tr>
        <th>Number_Of_Bikes</th>
        <td><?php echo $bike['num_bikes']?></td>
    </tr>
    <tr>
        <th>Engine_CC</th>
        <td><?php echo $bike['engine_cc']?></td>
    </tr>
    <tr>
        <th>Mileage</th>
        <td><?php echo $bike['mileage']?></td>
    </tr>
    <tr>
        <th>Speed</th>
        <td><?php echo $bike['speed']?></td>
    </tr>
    <tr>
        <th>Image1</th>
        <td><img src="../assets/images/bikes/<?php echo $bike['img1']?>"></td>
    </tr>
    <tr>
        <th>Image2</th>
        <td><img src="../assets/images/bikes/<?php echo $bike['img2']?>"></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo $bike['description']?></td>
    </tr>
    <tr>
        <th>Fuel_Type</th>
        <td><?php echo $bike['fuel_type']?></td>
    </tr>
    <tr>
        <th>Vehicle_Add_Time</th>
        <td><?php echo $bike['vehicle_add_time']?></td>
</tr>
 </table>