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
        <h2>login</h2>
    </div>
    <form action="./handler/login_db.php" method="post">
        <div class= "input-group">
            <label for="username">Username</label>
            <input type=text name=username>
        </div>
        <div class= "input-group">
            <label for="password"><P></P>password</label>
            <input type="password" name=password>
        </div>
        <div class= "input-group">
           <button type="submit" name = "login_user" class="btn">LOGIN</button>
        </div>
        <p>not yet a member? <a href ="register.php">sign up</a></p>

</form>
</body>
</html>