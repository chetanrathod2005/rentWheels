<?php
        include '../db.php';
        if (isset($_POST['add_vehicle'])) {
            $car_name = $_POST['car_name'];
            $brand_name = $_POST['brand'];
            $vehicle_type = $_POST['vehicle_type'];
            $model_year = $_POST['model_year'];
            $seat_capacity = $_POST['capacity'];
            $rent = $_POST['rent'];
            $num_cars = $_POST['num_cars'];
            $engine_cc = $_POST['engine_cc'];
            $mileage = $_POST['mileage'];
            $speed = $_POST['speed'];
            $description = $_POST['description'];
            $fuel_type = $_POST['fuel_type'];

              
            function uploadImage($fileInput,$target_dir) {
                $allowedType=['jpg','jpeg','png','webp'];
                if(isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error']==0) {
                    $filename=time()."_".($_FILES[$fileInput]['name']);
                    $target_file=$target_dir.$filename;
                     $fileExt=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                     if(!in_array($fileExt,$allowedType)) {
                        echo "upload file format should be jpg, jpeg, png or webp</br>";
                        return false;
                        
                     } 
                     if(($_FILES[$fileInput]['size'])>2*1024*1024) {
                        echo "Image size is not allowed more than 2MB</br>";
                        return false ;
                     }
                    $check=getimagesize($_FILES[$fileInput]['tmp_name']);
                    if($check!==false) {
                        move_uploaded_file($_FILES[$fileInput]['tmp_name'],$target_file);
                        return $filename;
                    }

                }
                return false;
            }
            $target_dir="../assets/images/cars/";
            $img1=uploadImage('img1',$target_dir);
            $img2=uploadImage('img2',$target_dir);
            $img3=uploadImage('img3',$target_dir);
            $img4=uploadImage('img4',$target_dir);

            if($img1===false || $img2===false || $img3===false || $img4===false) {
                echo "car Details Not save Because of invalid image upload</br>";
                exit;
            }
            date_default_timezone_set("Asia/Kolkata");

            $current_time = date("Y-m-d H:i:s");
            
            $stmt = $conn->prepare("INSERT INTO four_wheeler
                (car_name,brand,vehicle_type,model_year,
                seat_capacity,rent,num_cars,engine_cc,mileage,
                speed,img1,img2,img3,img4,
                description,fuel_type,vehicle_add_time)
                values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param("sssiiisiiisssssss",
                $car_name,$brand_name,$vehicle_type,
                $model_year,$seat_capacity,$rent,$num_cars,
                $engine_cc,$mileage,$speed,
                $img1,$img2,$img3,$img4,$description, 
                $fuel_type,$current_time);
                if($stmt->execute()) {
                $_SESSION['message']= "Vehicle details added successfully";
            }
        }
      ?>
<div class="tw_details">
    <h2>Add Four Wheeler Details</h2>
    <?php
    if(isset($_SESSION['message'])) {
    echo "<div class='session_msg'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']);
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-grid">

            <div class="form-group">
                <label for="car_name">Car Name</label>
                <input type="text" name="car_name" id="car_name"
                 placeholder="Enter Car Name" required>
            </div>

            <div class="form-group">
                <label for="brand">Brand Name</label>
                <input type="text" name="brand" id="brand"
                 placeholder="Enter Car Componey Name" required>
            </div>


            <div class="full-width">
                <label for="vehicle_type">Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type">
                    <option value="auto">Auto</option>
                    <option value="manual">Manual</option>

                </select>
            </div>

            <!-- <input type="text" name="Car_number" placeholder="Enter Car Number" 
                oninput="this.value = this.value.toUpperCase()"> -->
            <div class="form-group">
                <label for="model_year">Model Year</label>
                <input type="number" name="model_year" id="model_year"
                 placeholder="Enter Model Year" required>
            </div>

            <div class="form-group"> 
                <label for="capacity">Capacity</label>
                <input type="number" name="capacity" id="capacity" 
                placeholder="Enter Capacity of sitting" required>
            </div>

            <div class="form-group">
                 <label for="rent">Rent/Day</label>
                <input type="number" name="rent" id="rent" 
                placeholder="Enter Rent in form rent/ Day" required>
            </div>

            <div class="form-group"> 
                <label for="num_cars">Number of Car</label>
                <input type="number" name="num_cars" id="num_cars" 
                placeholder="Enter Number of available car" required>
            </div>

            <div class="form-group">
                <label for="engine_cc">Engine CC</label>
                <input type="text" name="engine_cc" id="engine_cc" 
                placeholder="Enter Engine CC" required>
            </div>

            <div class="form-group">
                <label for="mileage">Milage</label>
                <input type="number" name="mileage" id="mileage" 
                placeholder="Enter Car Mileage" required>
            </div>

            <div class="form-group">
                <label for="speed">Max Speed km/hr</label>
                <input type="number" name="speed" id="speed" 
                placeholder="Enter Maximum Speed km/hr" required>
            </div>

            <div class="full-width file-group">
                <label>Upload Images</label>
                <input type="file" name="img1" id="img1" required>
                <input type="file" name="img2" id="img2" required>
                <input type="file" name="img3" id="img3" required>
                <input type="file" name="img4" id="img4" required>
            </div>

            <div class="description">
                <label for="description">About Car</label>
                <textarea id="description" name="description" rows="5" cols="150"
                    placeholder="write about Car conditon" required></textarea>
            </div>

            <div class="fuel-section">
                <h3>Fuel Type</h3>
                <div class="fuel-options">
                    <label><input type="radio" name="fuel_type" value="petrol" required> Petrol</label>
                    <label><input type="radio" name="fuel_type" value="diesel"> Diesel</label>
                    <label><input type="radio" name="fuel_type" value="gas"> Gas</label>
                    <label><input type="radio" name="fuel_type" value="hybrid"> Hybrid</label>
                    <label><input type="radio" name="fuel_type" value="electric"> Electric</label>
                </div>
            </div>

            <div class="full-width">
                <button type="submit" name="add_vehicle" class="add_btn">
                    Save Vehicle Details
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    document.querySelectorAll('input[type=number]').forEach(input => {
    
    input.addEventListener('wheel', function(e) {
        e.preventDefault();
    });

});
</script>
    