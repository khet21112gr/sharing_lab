<?php



if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'employee' && $_SESSION['role'] !== 'admin') || ($_SESSION['role'] == "user")) {
    header( "Location: ../login.php");
    exit();
}
?>