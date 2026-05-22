          <?php
           include "../../../db.php";
           if(isset($_POST["update_details"])) {
            $id=$_POST['id'];
            $name=$_POST['car_name'];
            $brand=$_POST['brand'];
            $vehicle_type=$_POST['vehicle_type'];
            $model_year=$_POST['model_year'];
            $seat_capacity=$_POST['seat_capacity'];
            $rent=$_POST['rent'];
            $num_cars=$_POST['num_cars'];
            $engine_cc=$_POST['engine_cc'];
            $mileage=$_POST['mileage'];
            $speed=$_POST['speed'];
            $description=$_POST['description'];
            $fuel_type=$_POST['fuel_type'];
            $old_img1=$_POST['old_img1'];
            $old_img2=$_POST['old_img2'];
            $old_img3=$_POST['old_img3'];
            $old_img4=$_POST['old_img4'];
            $target_dir="../../../assets/images/cars/";
             

            if(isset($_FILES['new_img1']) && $_FILES['new_img1']['error']==0) {
                // echo "True";die;
                if(!empty($old_img1) &&  file_exists($target_dir.$old_img1)) {
                 unlink($target_dir.$old_img1);
                } 
                $img1=time()."_".$_FILES['new_img1']['name'];
                move_uploaded_file($_FILES['new_img1']['tmp_name'],$target_dir.$img1);
            } else {
                // $img1=$bike['img1'];
                // print_r($bike);
                //  echo "False";die;
                $img1=$old_img1;
            }

            if(isset($_FILES['new_img2']) && $_FILES['new_img2']['error']==0) {
                if(!empty($old_img2) &&  file_exists($target_dir.$old_img2)) {
                 unlink($target_dir.$old_img2);
                } 
                $img2=time()."_".$_FILES['new_img2']['name'];
                move_uploaded_file($_FILES['new_img2']['tmp_name'],$target_dir.$img2);
            } else {
                $img2=$old_img2;
            }

            if(isset($_FILES['new_img3']) && $_FILES['new_img3']['error']==0) {
                if(!empty($old_img3) &&  file_exists($target_dir.$old_img3)) {
                 unlink($target_dir.$old_img3);
                } 
                $img3=time()."_".$_FILES['new_img3']['name'];
                move_uploaded_file($_FILES['new_img3']['tmp_name'],$target_dir.$img3);
            } else {
                $img3=$old_img3;
            }

            if(isset($_FILES['new_img4']) && $_FILES['new_img4']['error']==0) {
                if(!empty($old_img4) &&  file_exists($target_dir.$old_img4)) {
                 unlink($target_dir.$old_img4);
                } 
                $img4=time()."_".$_FILES['new_img4']['name'];
                move_uploaded_file($_FILES['new_img4']['tmp_name'],$target_dir.$img4);
            } else {
                $img4=$old_img4;
            }
            
            
            $stmt=$conn->prepare("UPDATE four_wheeler
             set car_name=?,
             brand=?,
             vehicle_type=?,
             model_year=?,
             seat_capacity=?, 
             rent=?,
             num_cars=?,
             engine_cc=?,
             mileage=?,
             speed=?,
             img1=?,
             img2=?, 
             img3=?, 
             img4=?, 
             description=?,
             fuel_type=? 
             where id=?");
             $stmt->bind_param("sssiiiisiissssssi",$name,$brand,
             $vehicle_type,$model_year,$seat_capacity,$rent,
             $num_cars,$engine_cc,$mileage,$speed,$img1,
             $img2,$img3,$img4,$description,$fuel_type,$id);
             if($stmt->execute()) {
                echo "Details update successfully";
                    } else {
                        echo "error".$stmt->error;
                    }
                 }
          ?>