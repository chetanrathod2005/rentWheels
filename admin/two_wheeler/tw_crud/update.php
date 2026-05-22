        <?php
         $id=$_GET['id'];
        include '../../../db.php';
       
        $stmt=$conn->prepare("SELECT * FROM two_wheeler where id=?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $bike=$result->fetch_assoc();
        ?>
        <h2 style="text-align: center; margin-bottom: 50px;">Update Two Wheeler</h2>
  
     
   
    <form method="POST" enctype="multipart/form-data" id="update_data" >
        
        <div class="form-grid">
            <input type="hidden" name="id" value="<?php echo $bike['id'];?>">
            <div class="form-group">
                <label for="name">Bike Name</label>
                <input type="text" name="name" id="name" 
                value="<?php echo $bike['name']?>" required>
            </div>

            <div class="form-group">
                <label for="brand">Brand Name</label>
                <input type="text" name="brand" id="brand"
                value="<?php echo $bike['brand']?>" required>
            </div>


            <div class="full-width">
                <label for="vehicle_type">Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type">
                    <option value="geared"
                    <?php if($bike['vehicle_type']=='geared') echo 'selected';?> >
                    Geared</option>

                    <option value="gearless"
                    <?php if($bike['vehicle_type']=='gearless') echo 'selected';?>>    
                    Gearless</option>
                </select>
            </div>

            <div class="form-group">
                <label for="model_year">Model Year</label>
                <input type="number" name="model_year" id="model_year" 
                value="<?php echo $bike['model_year']?>" required>
            </div>

            <div class="form-group"> 
                <label for="seat_capacity">Capacity</label>
                <input type="number" name="seat_capacity" id="seat_capacity" 
                value="<?php echo $bike['seat_capacity']?>" required>
            </div>

            <div class="form-group">
                    <label for="rent">Rent/Day</label>
                <input type="number" name="rent" id="rent"
                value="<?php echo $bike['rent']?>" required>
            </div>

            <div class="form-group"> 
                <label for="num_bikes">Number of Bike</label>
                <input type="number" name="num_bikes" id="num_bikes"
                    value="<?php echo $bike['num_bikes']?>" required>
            </div>

            <div class="form-group">
                <label for="engine_cc">Engine CC</label>
                <input type="text" name="engine_cc" id="engine_cc"
                    value="<?php echo $bike['engine_cc']?>" required>
            </div>

            <div class="form-group">
                <label for="mileage">Milage</label>
                <input type="number" name="mileage" id="mileage" 
                value="<?php echo $bike['mileage']?>" required>
            </div>

            <div class="form-group">
                <label for="speed">Max Speed km/hr</label>
                <input type="number" name="speed" id="speed" 
                value="<?php echo $bike['speed']?>" required>
            </div>

            <div class="full-width file-group">
                <label>Upload Images</label>
                <p>Current Image 1:</p>
                <img src="../assets/images/bikes/<?php echo $bike['img1']; ?>" width="100">
                <input type="hidden" name="old_img1" value="<?php echo $bike['img1'];?>">
                <input type="file" name="new_img1" id="img1">

                <p>Current Image 2:</p>
                <img src="../assets/images/bikes/<?php echo $bike['img2']; ?>" width="100">
                <input type="hidden" name="old_img2" value="<?php echo $bike['img2'];?>">
                <input type="file" name="new_img2" id="new_img2" >
            </div>

            <div class="description">
                <label for="description">About Bike</label>
                <textarea id="description" name="description" required
                rows="5" cols="150"><?php echo $bike['description']?></textarea>
            </div>

            <div class="fuel-section">
                <h3>Fuel Type</h3>
                <div class="fuel-options">
                    <label>
                        <input type="radio" name="fuel_type" value="petrol"
                        <?php if($bike['fuel_type']=='petrol') echo 'checked';?>> 
                        Petrol</label>
                    <label>
                        <input type="radio" name="fuel_type" value="diesel"
                        <?php if($bike['fuel_type']=='diesel') echo 'checked';?>
                        > Diesel</label>
                    <label>
                        <input type="radio" name="fuel_type" value="gas"
                        <?php if($bike['fuel_type']=='gas') echo 'checked';?>
                        > Gas</label>
                    <label>
                        <input type="radio" name="fuel_type" value="electric"
                        <?php if($bike['fuel_type']=='electric') echo 'checked'; ?>
                        > Electric</label>
                       
                </div>
                
            </div>

            <div class="button-group">
                <input type="hidden" name="update_details">
                <button type="submit" name="update_details" class="update_btn">
                    Update
                </button>
                <button type="button" onclick="close_update_modal()" class="cancel_btn">
                Cancel
                </button>
            </div>
            </form>
        