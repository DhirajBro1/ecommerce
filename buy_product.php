<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the product from the database based on the product ID using prepared statements
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // If the product does not exist, redirect back to the products page
    if (!$product) {
        header("Location: buy_products.php");
        exit();
    }
} else {
    header("Location: buy_products.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Product - <?php echo $product['name']; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .product-details {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .product-image {
            width: 300px;
        }
        .product-image img {
            width: 100%;
            border-radius: 8px;
        }
        .product-info {
            flex: 1;
            max-width: 600px;
        }
        .product-info h2 {
            color: #007bff;
        }
        .product-info p {
            color: #555;
            font-size: 18px;
            line-height: 1.6;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-top: 20px;
        }
        .buy-btn {
            display: block;
            width: 200px;
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 20px;
            text-decoration: none;
        }
        .buy-btn:hover {
            background-color: #218838;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product Details</h1>
        <div class="product-details">
            <!-- Product Image -->
            <div class="product-image">
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>

            <!-- Product Information -->
            <div class="product-info">
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <div class="price">$<?php echo $product['price']; ?></div>
                <a href="cart.php?add_to_cart=<?php echo $product['id']; ?>" class="buy-btn">Add to Cart</a>
                <a href="buy_products.php" class="back-btn">Back to Products</a>
            </div>
        </div>
    </div>
</body>
</html>
