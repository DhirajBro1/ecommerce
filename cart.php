<?php
session_start();
include "db.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the cart exists in the session, if not, create one
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle item removal from cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: cart.php");
    exit();
}

// Handle rating submission
if (isset($_POST['rating'])) {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];

    // Save rating to the database
    $sql = "INSERT INTO ratings (product_id, user_id, rating) VALUES ('$product_id', '{$_SESSION['user_id']}', '$rating')";
    $conn->query($sql);
    echo "<script>alert('Rating submitted successfully!');</script>";
}

// Fetch products from the cart
$cart_items = [];
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = $conn->query($sql);
    $cart_items[] = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Your Cart</h2>
    <a href="dashboard.php">Back to Dashboard</a> | <a href="logout.php">Logout</a>
    <hr>

    <?php if (count($cart_items) > 0) { ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Remove</th>
                <th>Rating</th>
            </tr>
            <?php foreach ($cart_items as $item) { ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td>$<?php echo $item['price']; ?></td>
                    <td><?php echo $_SESSION['cart'][$item['id']]; ?></td>
                    <td><a href="cart.php?remove=<?php echo $item['id']; ?>">Remove</a></td>
                    <td>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <select name="rating">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                            <input type="submit" value="Submit Rating">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Your cart is empty.</p>
    <?php } ?>

</body>
</html>
