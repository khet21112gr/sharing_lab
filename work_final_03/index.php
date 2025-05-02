<?php 
session_start();
 if (!isset($_SESSION['username'])) {

  $_SESSION['msg'] = "you must login first";
  header('location: login.php');
 }
 if (isset($_GET['logout'])) {
     session_destroy();
     unset($_SESSION['username']);
     header('location: login.php');
 }
  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
</head>
<body>
    <div class = "header">
        <h2> Home page</h2>
    </div>
    <div class="content">

      <?php  if(isset($_SESSION['success'])):?>
      <div>
        <h3>
           <?php
           echo $_SESSION['success'];
           unset($_SESSION["sucesss"]);
           ?>
        </h3>
      </div>
      <?php endif; ?>
        <?php if (isset($_SESSION['username'])) :?>
          <P> Welcome <strong> <?php echo $_SESSION ['username'];?></strong></P>
          <P> <a href="index.php?logout='1'" style=color:red >logout</a></P>
        <?php endif; ?>
        <a href="dashboard.php"> DASH BOARD</a>
    </div>
</body>
</html>