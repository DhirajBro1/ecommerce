<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Add product to the cart
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    
    // If product is already in the cart, increase the quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    header("Location: cart.php");
    exit();
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Available Products</h2>

    <div>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div style="border:1px solid #000; padding:10px; margin:10px; width:200px; display:inline-block;">
                <img src="images/<?php echo $row['image']; ?>" width="150"><br>
                <strong><?php echo $row['name']; ?></strong><br>
                <p>Price: $<?php echo $row['price']; ?></p>
                <a href="buy.php?add_to_cart=<?php echo $row['id']; ?>">Add to Cart</a>
                <a href="buy_product.php?id=<?php echo $row['id']; ?>">Buy Now</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
