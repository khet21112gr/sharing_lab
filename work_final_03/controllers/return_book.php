<?php
session_start();
include('../server.php');

if (isset($_POST['book_id']) && isset($_SESSION['user_id'])) {
    $bookid = intval($_POST['book_id']);
    $user_id = intval($_SESSION['user_id']); 
    $check_rental_sql = "SELECT * FROM rentals WHERE book_id = '$bookid' AND user_id = '$user_id' AND status = 'rented'";
    $rental_check_result = mysqli_query($conn, $check_rental_sql);
    if (mysqli_num_rows($rental_check_result) > 0) {
        $update_rental_sql = "UPDATE rentals SET status = 'returned' WHERE book_id = '$bookid' AND user_id = '$user_id' AND status = 'rented'";
        if (mysqli_query($conn, $update_rental_sql)) {  
            $update_book_sql = "UPDATE books SET status = 'available' WHERE bookid = '$bookid'";
            if (mysqli_query($conn, $update_book_sql)) {
                header("Location: ../panel/user_panel.php");
                exit();
            } else {
                echo "Failed to update book status.";
            }
        } else {
            echo "Failed to update rental status.";
        }
    } else {
        echo "This book was not rented by you or already returned.";
    }
} else {
    echo "Invalid request.";
}
?>
