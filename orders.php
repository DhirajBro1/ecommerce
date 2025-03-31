<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders for the logged-in user
$sql = "SELECT orders.id, products.name, products.price, orders.order_date 
        FROM orders 
        JOIN products ON orders.product_id = products.id 
        WHERE orders.user_id = '$user_id' 
        ORDER BY orders.order_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>My Orders</h2>
    <a href="dashboard.php">Back to Dashboard</a> | <a href="logout.php">Logout</a>
    <hr>

    <?php if ($result->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Order Date</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>$<?php echo $row['price']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No orders placed yet.</p>
    <?php } ?>
</body>
</html>
