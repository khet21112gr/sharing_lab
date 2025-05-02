<?php
session_start();
include('../server.php');

// ตรวจสอบว่ามีการส่งข้อมูลมาครบ
if (!isset($_POST['book_id'])) {
    echo "Missing book ID!";
    exit();
}

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit();
}

$bookid = intval($_POST['book_id']);
$userid = intval($_SESSION['user_id']);

// ตรวจสอบว่าหนังสือยังว่าง
$check_sql = "SELECT * FROM books WHERE bookid = '$bookid' AND status = 'available'";
$check_result = mysqli_query($conn, $check_sql);

if (!$check_result) {
    echo "Query failed: " . mysqli_error($conn);
    exit();
}

if (mysqli_num_rows($check_result) === 0) {
    echo "หนังสือเล่มนี้ไม่พร้อมให้เช่า";
    exit();
}

// เปลี่ยนสถานะหนังสือ
$update_sql = "UPDATE books SET status = 'unavailable' WHERE bookid = '$bookid'";
if (!mysqli_query($conn, $update_sql)) {
    echo "ไม่สามารถอัปเดตสถานะหนังสือได้: " . mysqli_error($conn);
    exit();
}

// เพิ่มข้อมูลการเช่า
$rental_date = date("Y-m-d");
$insert_sql = "INSERT INTO rentals (user_id, book_id, rental_date, status) 
               VALUES ('$userid', '$bookid', '$rental_date', 'rented')";
if (!mysqli_query($conn, $insert_sql)) {
    echo "ไม่สามารถบันทึกข้อมูลการเช่าได้: " . mysqli_error($conn);
    exit();
}

// สำเร็จ
header("Location: ../panel/user_panel.php");
exit();
?>
