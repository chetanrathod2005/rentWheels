 <?php

           include "../../../db.php";
           if(isset($_POST['update_details'])) {
            $id=$_POST['id'];
            $name=$_POST['name'];
            $brand=$_POST['brand'];
            $vehicle_type=$_POST['vehicle_type'];
            $model_year=$_POST['model_year'];
            $seat_capacity=$_POST['seat_capacity'];
            $rent=$_POST['rent'];
            $num_bikes=$_POST['num_bikes'];
            $engine_cc=$_POST['engine_cc'];
            $mileage=$_POST['mileage'];
            $speed=$_POST['speed'];
            $description=$_POST['description'];
            $fuel_type=$_POST['fuel_type'];
            $old_img1=$_POST['old_img1'];
            $old_img2=$_POST['old_img2'];
            $target_dir="../../../assets/images/bikes/";
             

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
            
            
            $stmt=$conn->prepare("UPDATE two_wheeler
             set name=?,
             brand=?,
             vehicle_type=?,
             model_year=?,
             seat_capacity=?, 
             rent=?,
             num_bikes=?,
             engine_cc=?,
             mileage=?,
             speed=?,
             img1=?,
             img2=?, 
             description=?,
             fuel_type=? 
             where id=?");
             $stmt->bind_param("sssiiiisiissssi",$name,$brand,
             $vehicle_type,$model_year,$seat_capacity,$rent,
             $num_bikes,$engine_cc,$mileage,$speed,$img1,
             $img2,$description,$fuel_type,$id);
             if($stmt->execute()) {
                 echo "Details Updated Successfully"; 
            
                    } else {
                        echo "error".$stmt->error;
                    }
                 }
          ?>