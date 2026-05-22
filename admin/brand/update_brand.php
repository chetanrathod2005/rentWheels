<?php
include '../../db.php';
session_start();
if (isset($_POST['update_brand'])) {

    $id = $_POST['brand_id'];
    $brand_name = $_POST['brand_name'];
    $country_name = $_POST['country_name'];
    $old_logo = $_POST['old_logo'];
    $target_dir = "../../assets/images/brand_logo/";
    if (isset($_FILES['brand_logo']) && $_FILES['brand_logo']['error'] == 0) {
        if (!empty($old_logo) && file_exists($target_dir . $old_logo)) {
            unlink($target_dir . $old_logo);
        }
        $brand_logo = time() . "_" . $_FILES['brand_logo']['name'];
        move_uploaded_file($_FILES['brand_logo']['tmp_name'], $target_dir . $brand_logo);
    } else {
        $brand_logo = $old_logo;
    }
    $stmt = $conn->prepare("UPDATE brand SET brand_name=?,country_name=?,brand_logo=? WHERE id=?");
    $stmt->bind_param("sssi", $brand_name, $country_name, $brand_logo, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "details updated successfully";
    } else {
        echo "error" . $stmt->error;
    }
}

?>