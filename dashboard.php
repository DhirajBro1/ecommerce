<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch featured product (special promotion for girls)
$sql = "SELECT * FROM products WHERE is_featured = 1";
$result = $conn->query($sql);
$featured_product = $result->fetch_assoc();

// Fetch other products for the dashboard
$sql_all_products = "SELECT * FROM products";
$result_all_products = $conn->query($sql_all_products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
    background: linear-gradient(135deg, #6a11cb, #2575fc); /* Vibrant gradient */
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    color: #fff;
    background-attachment: fixed;  /* Keeps the background fixed when scrolling */
}

.container {
    width: 80%;
    max-width: 1200px;
    padding: 20px;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.4);  /* Semi-transparent container for content */
    border-radius: 10px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5);
}
.dashboard-buttons {
    display: flex;
    justify-content: center;
    gap: 20px; /* Space between buttons */
    margin-top: 30px;
}

.dashboard-buttons .btn {
    background-color: #007bff;
    color: white;
    padding: 12px 25px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 18px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.dashboard-buttons .btn:hover {
    background-color: #0056b3;
    transform: scale(1.05); /* Slight zoom effect on hover */
}

        h1 {
    font-size: 48px;
    font-weight: bold;
    color: #ffffff;
    text-align: center;
    text-transform: uppercase;
    background: linear-gradient(45deg, #ff6347, #ff1493);
    -webkit-background-clip: text;  /* Clips the background to the text */
    background-clip: text;  /* Allows gradient to apply only to the text */
    padding: 20px;
    letter-spacing: 4px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    margin-top: 50px;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5); /* Subtle shadow */
    animation: shine 1.5s ease-in-out infinite alternate;
}

/* Animation for the text shine effect */
@keyframes shine {
    0% {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.7), 0 0 20px rgba(255, 255, 255, 0.5), 0 0 30px rgba(255, 255, 255, 0.3);
    }
    100% {
        text-shadow: 0 0 15px rgba(255, 255, 255, 0.8), 0 0 25px rgba(255, 255, 255, 0.6), 0 0 35px rgba(255, 255, 255, 0.4);
    }
}

        .featured-product {
    background-color: #ff6347;
    color: white;
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 8px;
    text-align: center;
    position: relative;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.featured-product h2 {
    font-size: 36px;
    font-weight: bold;
    color: #ffffff;
    background: linear-gradient(45deg, #ff6347, #ff1493);
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    animation: shine 1.5s ease-in-out infinite alternate;
    margin-bottom: 20px; /* Added margin to separate from the next content */
}

.featured-product .discount {
    font-size: 24px;
    font-weight: bold;
    margin-top: 10px;
}

.featured-product img {
    width: 100%; /* Ensures the image is responsive */
    height: auto;
    max-width: 200px; /* Set a max-width for the image */
    border-radius: 10px;
    margin-top: 20px; /* Ensures the image doesn't stick to the text */
}

.featured-product p {
    font-size: 15px;
    font-weight: bold;
    color: #ffffff;
    background: linear-gradient(45deg, #ff6347, #ff1493);
    padding: 10px 20px;
    border-radius: 10px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 3px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: glow 1.5s ease-in-out infinite alternate;
    margin-bottom: 20px; 
}

.featured-product .price {
    font-size: 24px;
    font-weight: bold;
    margin-top: 10px;
}

.featured-product .btn {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    margin-top: 20px;
    font-size: 18px;
}

.featured-product .btn:hover {
    background-color: #0056b3;
}

/* Animation to make the text shine */
@keyframes shine {
    0% {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.7), 0 0 20px rgba(255, 255, 255, 0.5), 0 0 30px rgba(255, 255, 255, 0.3);
    }
    100% {
        text-shadow: 0 0 15px rgba(255, 255, 255, 0.8), 0 0 25px rgba(255, 255, 255, 0.6), 0 0 35px rgba(255, 255, 255, 0.4);
    }
}
@keyframes glow {
    0% {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.7), 0 0 20px rgba(255, 255, 255, 0.5), 0 0 30px rgba(255, 255, 255, 0.3);
    }
    100% {
        text-shadow: 0 0 15px rgba(255, 255, 255, 0.8), 0 0 25px rgba(255, 255, 255, 0.6), 0 0 35px rgba(255, 255, 255, 0.4);
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        
        <?php if ($featured_product) { ?>
            <!-- Featured Product (Promotion Banner) -->
            <div class="featured-product">
                <h2>Special Offer!for Girls</h2>
                <p>90% Off on Brain</p>
                <div class="discount">Hurry Up! Limited Time Offer</div>
                <div>
                    <img src="images/<?php echo $featured_product['image']; ?>" alt="<?php echo $featured_product['name']; ?>" width="200px">
                </div>
                <h3><?php echo $featured_product['name']; ?></h3>
                <p><?php echo $featured_product['description']; ?></p>
                <p class="price">$<?php echo $featured_product['price']; ?></p>
                <a href="buy_product.php?id=<?php echo $featured_product['id']; ?>" class="btn">Buy Now</a>
                <div class="dashboard-buttons">
            <a href="buy.php" class="btn">Buy Products</a> 
            <a href="logout.php" class="btn">Logout</a>
        </div>
            </div>
        <?php } else { ?>
            <p>No special promotions at the moment.</p>
        <?php } ?>
        </div>
    </div>
</body>
</html>
