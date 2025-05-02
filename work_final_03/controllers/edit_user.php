<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
 
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
    <title>edit user</title>
</head>
<body>
 <?php
 $sql = "SELECT * FROM users WHERE id = '".$_GET['id']."'";
 $query = mysqli_query($conn , $sql);
 $user_arr = mysqli_fetch_assoc($query);
 ?>
    <form action="./edit_user.php" method="GET">
        <input type="text" name=id id="" value="<?php echo $user_arr['id']?>" hidden>
        <input type="text" name=username id="" value="<?php echo $user_arr['username']?>">
        <input type="text" name=email id="" value="<?php echo $user_arr['email']?>">
        <input type="password" name=password id="" value="<?php echo $user_arr['password']?>">
        <select name ="role">
          <option value="admin" <?php echo ($user_arr['role']=="admin")?"selected":"";?>>admin </option>
          <option value="employee" <?php echo ($user_arr['role']=="employee")?"selected":"";?>>employee </option>
          <option value="user" <?php echo ($user_arr['role']=="user")?"selected":"";?>>user </option>
        <input type="submit" value="Add">
        <a href="../panel/admin_panel.php"><button type="button">BACK</button></a>

        </select>
        
    </form>
    <?php 
    if(isset($_GET['username'])&&isset($_GET['password'])&&isset($_GET['role'])&&isset($_GET['email'])&&isset($_GET['id'])){
        $id = $_GET['id'];
        $usr = $_GET['username'];
        $pas = $_GET['password'];
        $rol = $_GET['role'];
        $eml = $_GET["email"];
    
        $sql = "UPDATE  users  SET   username ='".$usr."', email ='".$eml."', PASSWORD ='".$pas."', role ='".$rol."' WHERE id =".$id;
        if( $query = mysqli_query($conn,$sql)){
        header ("location: ../dashboard.php");
        }else{
        header("location: ./add_user.php");
        }
    }
    
    ?>
</body>
</html>