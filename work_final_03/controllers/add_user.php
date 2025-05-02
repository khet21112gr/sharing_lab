<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    //ป้องกันคนที่ไม่สมัครและให้เข้าเฉพาะแอด 
    session_destroy();
    header("Location: ../login.php");
   
}
include("../server.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add user</title>
</head>
<body>

    <form action="./add_user.php" method="GET">
        <input type="text" name=username id="">
        <input type="text" name=email id="">
        <input type="password" name=password id="">
        <select name ="role">
          <option value="admin">admin </option>
          <option value="employee">employee </option>
          <option value="user">user </option>
        <input type="submit" value="Add">

        <a href="../panel/admin_panel.php"><button type="button">BACK</button></a>

        </select>
        
    </form>
    <?php 
    if(isset($_GET['username'])&&isset($_GET['password'])&&isset($_GET['role'])&&isset($_GET["email"])){
        $usr = $_GET['username'];
        $pas = $_GET['password'];
        $rol = $_GET['role'];
        $eml = $_GET["email"];
           
        $sql = "INSERT INTO users
         values (null,
         '".$usr."',
         '".$eml."',
         '".$pas."',
         '".$rol."')";
       if( $query = mysqli_query($conn,$sql)){
       header ("location: ../panel/admin_panel.php");
       }else{
       header("location: ./add_user.php");
       }
    }
      
    ?>
</body>
</html>