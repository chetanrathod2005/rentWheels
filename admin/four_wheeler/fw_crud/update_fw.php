        <?php
         $id=$_GET['id'];
        include '../../../db.php';
       
        $stmt=$conn->prepare("SELECT * FROM four_wheeler where id=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $car=$result->fetch_assoc();
        ?>
               
   <form method="POST" enctype="multipart/form-data" id="update_data">
        
        <div class="form-grid">
            <input type="hidden" name="id" value="<?php echo $car['id'];?>">
            <div class="form-group">
                <label for="name">Car Name</label>
                <input type="text" name="car_name" id="name" 
                value="<?php echo $car['car_name']?>" required>
            </div>

            <div class="form-group">
                <label for="brand">Brand Name</label>
                <input type="text" name="brand" id="brand"
                value="<?php echo $car['brand']?>" required>
            </div>


            <div class="full-width">
                <label for="vehicle_type">Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type">
                    <option value="auto"
                    <?php if($car['vehicle_type']=='auto') echo 'selected';?> >
                    Auto</option>

                    <option value="manual"
                    <?php if($car['vehicle_type']=='manual') echo 'selected';?>>    
                    Manual</option>
                </select>
            </div>

            <div class="form-group">
                <label for="model_year">Model Year</label>
                <input type="number" name="model_year" id="model_year" 
                value="<?php echo $car['model_year']?>" required>
            </div>

            <div class="form-group"> 
                <label for="seat_capacity">Capacity</label>
                <input type="number" name="seat_capacity" id="seat_capacity" 
                value="<?php echo $car['seat_capacity']?>" required>
            </div>

            <div class="form-group">
                    <label for="rent">Rent/Day</label>
                <input type="number" name="rent" id="rent"
                value="<?php echo $car['rent']?>" required>
            </div>

            <div class="form-group"> 
                <label for="num_cars">Number of car</label>
                <input type="number" name="num_cars" id="num_cars"
                    value="<?php echo $car['num_cars']?>" required>
            </div>

            <div class="form-group">
                <label for="engine_cc">Engine CC</label>
                <input type="text" name="engine_cc" id="engine_cc"
                    value="<?php echo $car['engine_cc']?>" required>
            </div>

            <div class="form-group">
                <label for="mileage">Milage</label>
                <input type="number" name="mileage" id="mileage" 
                value="<?php echo $car['mileage']?>" required>
            </div>

            <div class="form-group">
                <label for="speed">Max Speed km/hr</label>
                <input type="number" name="speed" id="speed" 
                value="<?php echo $car['speed']?>" required>
            </div>

            <div class="full-width file-group">
                <label>Upload Images</label>
                <p>Current Image 1:</p>
                <img src="../assets/images/cars/<?php echo $car['img1']; ?>" width="100">
                <input type="hidden" name="old_img1" value="<?php echo $car['img1'];?>">
                <input type="file" name="new_img1" id="img1">

                <p>Current Image 2:</p>
                <img src="../assets/images/cars/<?php echo $car['img2']; ?>" width="100">
                <input type="hidden" name="old_img2" value="<?php echo $car['img2'];?>">
                <input type="file" name="new_img2" id="new_img2" >
               
                <p>Current Image 3:</p>
                <img src="../assets/images/cars/<?php echo $car['img3']; ?>" width="100">
                <input type="hidden" name="old_img3" value="<?php echo $car['img3'];?>">
                <input type="file" name="new_img3" id="new_img3" >

                <p>Current Image 4:</p>
                <img src="../assets/images/cars/<?php echo $car['img4']; ?>" width="100">
                <input type="hidden" name="old_img4" value="<?php echo $car['img4'];?>">
                <input type="file" name="new_img4" id="new_img4" >
            </div>

            <div class="description">
                <label for="description">About car</label>
                <textarea id="description" name="description" 
                rows="5" cols="150" required><?php echo $car['description']?></textarea>
            </div>

            <div class="fuel-section">
                <h3>Fuel Type</h3>
                <div class="fuel-options">
                    <label>
                        <input type="radio" name="fuel_type" value="petrol"
                        <?php if($car['fuel_type']=='petrol') echo 'checked';?>> 
                        Petrol</label>
                    <label>
                        <input type="radio" name="fuel_type" value="diesel"
                        <?php if($car['fuel_type']=='diesel') echo 'checked';?>
                        > Diesel</label>
                    <label>
                        <input type="radio" name="fuel_type" value="gas"
                        <?php if($car['fuel_type']=='gas') echo 'checked';?>
                        > Gas</label>
                    <label>
                        <input type="radio" name="fuel_type" value="hybrid"
                        <?php if($car['fuel_type']=='hybrid') echo 'checked';?>
                        > Hybrid</label>
                    <label>
                        <input type="radio" name="fuel_type" value="electric"
                        <?php if($car['fuel_type']=='electric') echo 'checked'; ?>
                        > Electric</label>
                       
                </div>
                
            </div>

            <div class="button-group">
                <input type="hidden"  name="update_details" value="<?php echo $car['id']?>" >
                <button type="submit" name="update_details" class="update_btn">
                    Update
                </button>
                <button type="button" onclick="close_update_modal()" class="cancel_btn">
                Cancel
                </button>
            </div>
            </form>
            
 