<h2>Different brand vehicle </h2>

<?php
include '../db.php';
if (isset($_POST['add_brand'])) {
    $brand_name = $_POST['brand_name'];
    $country_name = $_POST['country_name'];

    function uploadImage($fileInput, $target_dir)
    {
        $allowedType = ['jpg', 'jpeg', 'png'];
        if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] == 0) {
            $filename = time() . "_" . ($_FILES[$fileInput]['name']);
            $target_file = $target_dir . $filename;
            $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (!in_array($fileExt, $allowedType)) {
                echo "upload file format should be jpg, jpeg, or png</br>";
                return false;

            }
            if (($_FILES[$fileInput]['size']) > 2 * 1024 * 1024) {
                echo "Image size is not allowed more than 2MB</br>";
                return false;
            }
            $check = getimagesize($_FILES[$fileInput]['tmp_name']);
            if ($check !== false) {
                move_uploaded_file($_FILES[$fileInput]['tmp_name'], $target_file);
                return $filename;
            }

        }
        return false;
    }
    $target_dir = "../assets/images/brand_logo/";
    $brand_logo = uploadImage('brand_logo', $target_dir);

    if ($brand_logo === false) {
        echo "Brand Details Not save Because of invalid image upload</br>";
        exit;
    }
    $stmt = $conn->prepare("INSERT INTO brand(brand_name,country_name,brand_logo) VALUES(?,?,?)");
    $stmt->bind_param("sss", $brand_name, $country_name, $brand_logo);
    if ($stmt->execute()) {
        $_SESSION['add_brand']="Brand details added successfully";
    }
}
?>

<div class="add_brand">
    <form method="post" enctype="multipart/form-data">
        <h3>Add new brand</h3>

        <div class="form_group">
            <input type="text" name="brand_name" id="brand_name" 
                placeholder="Enter Brand Name" required>
        </div>

        <div class="form_group">
            <input type="text" name="country_name" id="country_name" 
                placeholder="Enter Country Name" required>
        </div>

        <div class="file-upload">
        <input type="file" id="brand_logo" name="brand_logo" hidden>
        <label for="brand_logo" class="upload-btn">Upload Logo</label>
        <span id="file-name">No file selected</span>
    </div>

        <button type="submit" name="add_brand">Add</button>
    </form>
</div>
<?php
if(isset($_SESSION['add_brand'])) {
    echo "<div class='add_msg'>{$_SESSION['add_brand']}</div>";
    unset($_SESSION['add_brand']);
}
?>

<div class="brand_details">
    <h2>Our Brand's</h2>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div class=session_msg>{$_SESSION['message']}</div>";
        unset($_SESSION['message']);
    }
    ?>
         <?php
            $stmt = $conn->prepare("SELECT * FROM brand ");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $count = 1;
                echo " <div class='brand_table'>
                <table border='1'>
                <tr>
                <th>No.</th>
                <th>Brand Name</th>
                <th>Country Name</th>
                <th>Brand Logo</th>
                <th>Update</th>
                <th>Delete</th>
                 </tr>";
                while ($brand = $result->fetch_assoc()) {

                    echo "
            <tr>
            <td>{$count}</td>
            <td>{$brand['brand_name']}</td>
            <td>{$brand['country_name']}</td>
            <td><img src='../assets/images/brand_logo/{$brand['brand_logo']}' width=120px; height=50px></td>
            <td><button class='update_btn' onclick='update_brand({$brand['id']})'>Update</button></td>
            <td><button class='delete_btn' name='delete_brand' onclick='delete_brand({$brand['id']})'>Delete</button></td>
            </tr> ";
                    $count++;
                }
            } else {
                echo "Currently not collab with any brand vehicle";
            }
            ?>
        </table>

    </div>
</div>

<!-- update brand model -->
<div id="update_brand">
    <div class="update_details">
        <div id="update_content">

        </div>
    </div>
</div>

<!-- Delete brand modal -->
<div id="delete_model">
    <div class="delete_popup">
        <p>Are you sure you want to delete this Brand?</p>
        <p>Once if You delete this brand it will delete permanently</p>
        <div class="dlt_btn">
            <button type="submit" name="delete" class="delete_button" onclick="final_delete()">Delete</button>
            <button type="button" class="cancel_button" onclick="close_delete_model()">Cancel</button>
        </div>
    </div>
</div>

<script src="../assets/js/brand.js"></script>