<?php
session_start();
include("../server.php");

// Fetch user's rented books
$user_id = $_SESSION['user_id'];
$sql_rented = "SELECT rentals.rental_id, rentals.book_id, books.title, books.author, rentals.rental_date
               FROM rentals
               JOIN books ON rentals.book_id = books.bookid
               WHERE rentals.user_id = '$user_id' AND rentals.status = 'rented'";
$result_rented = mysqli_query($conn, $sql_rented);

// Fetch available books to rent
$sql_available = "SELECT bookid, title, author, quantity
                  FROM books
                  WHERE status = 'available' AND quantity > 0";
$result_available = mysqli_query($conn, $sql_available);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <a href="../logout.php"><button>Logout</button></a>
    <hr>
    
    <h3>Your Rented Books</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Rental Date</th>
            <th>Action</th>
        </tr>

        <?php while ($rental = mysqli_fetch_assoc($result_rented)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($rental['book_id']); ?></td>
                <td><?php echo htmlspecialchars($rental['title']); ?></td>
                <td><?php echo htmlspecialchars($rental['author']); ?></td>
                <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                <td>
                    <form action="../controllers/return_book.php" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $rental['book_id']; ?>">
                        <button type="submit">Return</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>

    <hr>

    <h3>Available Books to Rent</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>

        <?php while ($book = mysqli_fetch_assoc($result_available)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($book['bookid']); ?></td>
                <td><?php echo htmlspecialchars($book['title']); ?></td>
                <td><?php echo htmlspecialchars($book['author']); ?></td>
                <td><?php echo htmlspecialchars($book['quantity']); ?></td>
                <td>
                    <form action="../controllers/rent_book.php" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $book['bookid']; ?>">
                        <button type="submit">Rent</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
