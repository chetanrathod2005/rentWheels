<?php
session_start();
include "../db.php";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $_SESSION['active_form']='login';
      if(empty($email) || empty($password) ){
        $_SESSION['message']="All fields are required";
        header("location:../index.php?page=home&show=login");
        exit();
    }


    $stmt = $conn->prepare("SELECT * FROM users where email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            if ($user["role"] === "admin") {
                 $_SESSION["admin_email"] = $user['email'];
                 $_SESSION["admin_id"]=$user["id"];
                header("location:../admin/dashboard.php");
                exit();
            } elseif( ($user["role"] === "user")) {
                $_SESSION["user_email"]=$user['email'];
                $_SESSION["user_id"]=$user['id'];
                header("location:dashboard.php");
                exit();
            }
        } else {
            $_SESSION["message"]= "<p>wrong password</p>";
            header("location:../index.php?page=home&show=login");
            exit();
        }
    } else {
        $_SESSION["message"]= "<p>user is not registered</p>";
        header("location:../index.php?page=home&show=login");
            exit();
    }
}
?>