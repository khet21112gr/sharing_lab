<?php
session_start();
require("../server.php");
$id = $_GET['id'];
$sql = "DELETE FROM users where id = '".$id."'";
if($query = mysqli_query($conn,$sql)){
    header('location: ../panel/admin_panel.php');
}else{
    echo "ลบไม่สำเร็จ";
}
?>