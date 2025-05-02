<?php
include("server.php");
session_start();
if (!isset($_SESSION['role'])) {

    session_destroy();
    header("Location: ../login.php");
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <?php
    if($_SESSION['role'] == "admin"){
     header("location: panel/admin_panel.php");
    }else if($_SESSION['role'] == "employee"){
     header("location: panel/employee_panel.php");
    }else if($_SESSION['role'] == "user"){
     header("location: ./panel/user_panel.php");
    }else{
        // session_destroy();
      //   header("location: ./index.php");
       // require("./admin_panel.php");
    }
    ?>
    
</body>
</html>