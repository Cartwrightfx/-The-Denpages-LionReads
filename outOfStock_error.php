<?php
session_start();
// Retrieve the list of out of stock books from the query parameter
$out_of_stock_books_str = isset($_GET['books']) ? $_GET['books'] : '';
$out_of_stock_books = explode(',', $out_of_stock_books_str);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=JetBrains Mono">
    <script src="https://kit.fontawesome.com/ff24e75514.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="./img/LionReads-logo.png" type="image/x-icon">
    <title>Out of Stock | Lionreads your mobile bookstore..</title>
    <style>
        body {
            font-family: 'JetBrains Mono', sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding: 50px;
        }

        .error-message {
            background-color: #ff6347; /* Tomato Red */
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .back-link {
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="error-message">
        <h1>Out of Stock</h1>
        <p>The following books are out of stock:</p>
        <ul>
            <?php foreach ($out_of_stock_books as $book): ?>
                <li><?php echo $book; ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Please remove these books from your cart and continue shopping.</p>
        <p>You can <a href="bookshop.php">return to the bookshop</a> to browse our other products.</p>
    </div>
</body>
</html>
