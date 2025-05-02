<?php
session_start();
include('../server.php');

$errors = array();

if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1'] ?? '');
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2'] ?? '');
    
    if (empty($username)) array_push($errors, "Username is required");
    if (empty($email)) array_push($errors, "Email is required");
    if (empty($password_1)) array_push($errors, "Password is required");
    if ($password_1 != $password_2) array_push($errors, "Passwords do not match");

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        if ($result['username'] === $username) array_push($errors, "Username already exists");
        if ($result['email'] === $email) array_push($errors, "Email already exists");
    }

    if (count($errors) == 0) {
        $password = $password_1;
        $role = "user";

        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            $user_id = mysqli_insert_id($conn);
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id; // สำคัญมาก สำหรับการใช้งาน session หลังเช่า
            $_SESSION['success'] = "You are now logged in";
            header('location: ../index.php');
            exit();
        } else {
            array_push($errors, "Failed to register user.");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <?php if (count($errors) > 0): ?>
        <div style="color:red;">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password_1"><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_2"><br><br>

        <button type="submit" name="reg_user">Register</button>
    </form>
</body>
</html>
