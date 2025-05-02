<?php
session_start();
require("../server.php");

if (isset($_GET['bid'])) {
    $bid = $_GET['bid'];  

    $sql = "DELETE FROM books WHERE bookid = '$bid'";  

    if ($query = mysqli_query($conn, $sql)) {
        header('location: ../panel/lib_panel.php');  
    } else {
        echo "Failed to delete book.";
    }
} 
?>
