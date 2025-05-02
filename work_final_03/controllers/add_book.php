<?php
session_start();
include("../server.php");
include("../middleware/auth_employee.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>employee panel</title>
</head>
<body>
<?php
$errors = array();
$success = '';

if (isset($_POST['add_book'])) {
    $bookid = mysqli_real_escape_string($conn, $_POST['bookid'] ?? '');
    $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
    $author = mysqli_real_escape_string($conn, $_POST['author'] ?? '');
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity'] ?? '');

    if (empty($bookid)) {
        array_push($errors, "Book ID is required");
    }
    if (empty($title)) {
        array_push($errors, "Title is required");
    }
    if (empty($author)) {
        array_push($errors, "Author is required");
    }
    if (!is_numeric($quantity) || $quantity < 1) {
        array_push($errors, "Quantity must be a positive number");
    }

    $check_query = "SELECT * FROM books WHERE bookid = '$bookid' LIMIT 1";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_fetch_assoc($result)) {
        array_push($errors, "Book ID already exists");
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO books (bookid, title, author, quantity) VALUES ('$bookid', '$title', '$author', $quantity)";
        if (mysqli_query($conn, $sql)) {
            $success = "Book added successfully!";
        } else {
            array_push($errors, "Error adding book: " . mysqli_error($conn));
        }
    }
}

?>
<?php if (!empty($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Book ID:</label><br>
        <input type="text" name="bookid"><br><br>

        <label>Title:</label><br>
        <input type="text" name="title"><br><br>

        <label>Author:</label><br>
        <input type="text" name="author"><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="1"><br><br>

        <button type="submit" name="add_book">Add Book</button>
    </form>

    <br>
    <a href="../panel/lib_panel.php"><button>Back</button></a>
</body>
</html>