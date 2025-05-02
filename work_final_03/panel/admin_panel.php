
<label>Welcome Admin</label>
<a href="./lib_panel.php">
<button>MANAGE</button>
<br>
<hr>
<a href="../logout.php"><button>logout</button></a>
<br>
<hr>
<a href="../controllers/add_user.php"> <button>add user</button> </a>
<table border="1">
     <tr>
        <th>id</th>
        <th>Username</th>
        <th>Role</th>
        <th>action</th>
     </tr>
<?php
session_start();
include("../server.php");
include("../middleware/auth_admin.php");
$sql = "SELECT * FROM users";
$query = mysqli_query($conn,$sql)or die("err query user!");
while($user_arr = mysqli_fetch_array($query)){
    $is_admin = $_SESSION['role'] === 'admin' && $_SESSION['username'] === $user_arr['username'];
?>
    <tr>
        <td><?php echo $user_arr['id']?></td>
        <td><?php echo $user_arr['username']?></td>
        <td><?php echo $user_arr['role']?></td>
        <td>
           
            <?php if (!$is_admin) { ?>
                <a href="../controllers/edit_user.php?id=<?php echo $user_arr['id']?>" > 
          <button>Edit</button> 
       </a>
                <a href="..//controllers/delete_user.php?id=<?php echo $user_arr['id']?>" > 
                    <button>Delete</button> 
                </a>
            <?php } ?>
        </td>
    </tr>
  


<?php
}
?>
</table>
