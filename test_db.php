<?php
include "db.php"; // Include the database connection

if ($conn) {
    echo "Database connected successfully!";
} else {
    echo "Database connection failed!";
}
?>
