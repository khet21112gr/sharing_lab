<?php
session_start();
include("../server.php");
include("../middleware/auth_employee.php");

$sql_books = "SELECT * FROM books";
$result_books = mysqli_query($conn, $sql_books);

$sql_rentals = "SELECT 
                    rentals.rental_id,
                    users.username,
                    books.title,
                    books.author,
                    rentals.rental_date,
                    rentals.status
                FROM rentals
                JOIN users ON rentals.user_id = users.id
                JOIN books ON rentals.book_id = books.bookid
                ORDER BY rentals.rental_date DESC";
$result_rentals = mysqli_query($conn, $sql_rentals);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book and Rental List</title>
</head>
<body>
    <h2>📚 Book List</h2>
     
    <!-- Book List Table -->
    <table border="1" cellpadding="10">
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
     

<!-- Add Book Button -->
<a href="../controllers/add_book.php"><button>Add New Book</button></a>
<br><br>

<!-- The Book List Table Here -->

        <?php while ($book = mysqli_fetch_assoc($result_books)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($book['bookid']); ?></td>
            <td><?php echo htmlspecialchars($book['title']); ?></td>
            <td><?php echo htmlspecialchars($book['author']); ?></td>
            <td><?php echo $book['quantity']; ?></td>
            <td><?php echo ucfirst($book['status']); ?></td>
            <td>
                <a href="../controllers/rm_book.php?bid=<?php echo $book['bookid']; ?>" onclick="return confirm('Are you sure?');">
                    <button>Delete</button>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <hr>

    <h2>📚 Rented Books</h2>

    <!-- Rented Books Table -->
    <table border="1" cellpadding="10">
        <tr>
            <th>Rental ID</th>
            <th>Username</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Rental Date</th>
            <th>Status</th>
        </tr>
        <?php while ($rental = mysqli_fetch_assoc($result_rentals)) { ?>
        <tr>
            <td><?php echo $rental['rental_id']; ?></td>
            <td><?php echo htmlspecialchars($rental['username']); ?></td>
            <td><?php echo htmlspecialchars($rental['title']); ?></td>
            <td><?php echo htmlspecialchars($rental['author']); ?></td>
            <td><?php echo $rental['rental_date']; ?></td>
            <td><?php echo ucfirst($rental['status']); ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
