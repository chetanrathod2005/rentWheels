<?php
$conn= new mysqli("localhost","root","","vrms");
$conn->query("SET time_zone = '+05:30'");
date_default_timezone_set("Asia/Kolkata");
if($conn->connect_error) {
    die("database not connected<br>");
} 