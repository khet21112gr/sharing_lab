<?php include("server.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page </title>
</head>
<body>
    <div class="header">
        <h2>register</h2>
    </div>
    <form action="./handler/register_db.php" method = "post">
        <div class= "input-group">
            <label for="username">Username</label>
            <input type=text name=username required>
        </div>
        <div class= "input-group">
            <label for="email">Email</label>
            <input type=email name=email>
        </div>
        <div class= "input-group">
            <label for="password_1">password</label>
            <input type="password" name=password_1>
        </div>
        <div class= "input-group">
            <label for="password_2">Comfirm password</label>
            <input type="password" name=password_2>
        </div>
        <div class= "input-group">
           <button type="submit" name = "reg_user" class="btn">register</button>
        </div>
        <p>Already a member? <a href ="login.php">login</a></p>

</form>
</body>
</html>