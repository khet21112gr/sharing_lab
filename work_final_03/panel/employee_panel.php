<?php
session_start();
include("../server.php");
include("../middleware/auth_employee.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>employee panel</title>
</head>
<body>
     <h3>this is employee panel</h3>
     <?php
     echo $_SESSION ["username"]
     
     ?>
     <br>
      <a href="./lib_panel.php">
        <button>MANAGE</button>
        <a href="../logout.php"><button>logout</button></a>
    </a>
    <br>
   
</body>
</html>