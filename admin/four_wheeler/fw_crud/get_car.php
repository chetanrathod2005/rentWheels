 <link rel="styelsheet" href="../assets/css/admin_css/manage_tw.css">
 <?php 
 include '../../../db.php';
 $id=$_GET['id'];
 $stmt=$conn->prepare("SELECT * FROM four_wheeler where id=?");
 $stmt->bind_param("i",$id);
 $stmt->execute();
 $result=$stmt->get_result();
 $car=$result->fetch_assoc();
 ?>
 <h3><?php echo $car['car_name']?> Details</h3>
 <table border="1" class="main_table">
    <tr>
        <th>car_Name</th>
        <td><?php echo $car['car_name']?></td>
    </tr>
    <tr>
        <th>Brand</th>
        <td><?php echo $car['brand']?></td>
    </tr>
    <tr>
        <th>vehicle_type</th>
        <td><?php echo $car['vehicle_type']?></td>
    </tr>
    <tr>
        <th>Model_Year</th>
        <td><?php echo $car['model_year']?></td>
    </tr>
    <tr>
        <th>Seat_Capacity</th>
        <td><?php echo $car['seat_capacity']?></td>
    </tr>
    <tr>
        <th>rent</th>
        <td><?php echo $car['rent']?></td>
    </tr>
    <tr>
        <th>Number_Of_cars</th>
        <td><?php echo $car['num_cars']?></td>
    </tr>
    <tr>
        <th>Engine_CC</th>
        <td><?php echo $car['engine_cc']?></td>
    </tr>
    <tr>
        <th>Mileage</th>
        <td><?php echo $car['mileage']?></td>
    </tr>
    <tr>
        <th>Speed</th>
        <td><?php echo $car['speed']?></td>
    </tr>
    <tr>
        <th>Image1</th>
        <td><img src="../assets/images/cars/<?php echo $car['img1']?>"></td>
    </tr>
    <tr>
        <th>Image2</th>
        <td><img src="../assets/images/cars/<?php echo $car['img2']?>"></td>
    </tr>
    <tr>
        <th>Image3</th>
        <td><img src="../assets/images/cars/<?php echo $car['img3']?>"></td>
    </tr>
    <tr>
        <th>Image4</th>
        <td><img src="../assets/images/cars/<?php echo $car['img4']?>"></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo $car['description']?></td>
    </tr>
    <tr>
        <th>Fuel_Type</th>
        <td><?php echo $car['fuel_type']?></td>
    </tr>
    <tr>
        <th>Vehicle_Add_Time</th>
        <td><?php echo $car['vehicle_add_time']?></td>
</tr>
 </table>