# E-Commerce Application

A simple, feature-rich e-commerce web application built with PHP and MySQL. This application allows users to browse products, add items to their cart, and make purchases with a clean and modern user interface.

## Features

- **User Authentication**
  - User registration with password hashing
  - Secure login system
  - Session management
  
- **Product Management**
  - Browse all available products
  - Featured product promotions
  - Product images and descriptions
  - Dynamic pricing display

- **Shopping Cart**
  - Add products to cart
  - Manage cart quantities
  - Remove items from cart
  - Product rating system

- **Order Processing**
  - Buy products directly
  - View order history
  - Secure checkout process

- **Responsive Design**
  - Modern gradient backgrounds
  - Animated UI elements
  - Mobile-friendly layout

## Technology Stack

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML5, CSS3
- **Server**: XAMPP (Apache + MySQL)

## Installation

### Prerequisites

- XAMPP or any PHP development environment (PHP 7.0+)
- MySQL database server
- Web browser

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/DhirajBro1/ecommerce.git
   cd ecommerce
   ```

2. **Set up the database**
   - Start XAMPP and ensure Apache and MySQL are running
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `ecommerce_db`
   - Create the following tables:

   **Users Table:**
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(100) NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

   **Products Table:**
   ```sql
   CREATE TABLE products (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       description TEXT,
       price DECIMAL(10, 2) NOT NULL,
       image VARCHAR(255),
       is_featured TINYINT(1) DEFAULT 0,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

   **Ratings Table:**
   ```sql
   CREATE TABLE ratings (
       id INT AUTO_INCREMENT PRIMARY KEY,
       product_id INT NOT NULL,
       user_id INT NOT NULL,
       rating INT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (product_id) REFERENCES products(id),
       FOREIGN KEY (user_id) REFERENCES users(id)
   );
   ```

   **Orders Table (if needed):**
   ```sql
   CREATE TABLE orders (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       product_id INT NOT NULL,
       quantity INT DEFAULT 1,
       total_price DECIMAL(10, 2) NOT NULL,
       order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id),
       FOREIGN KEY (product_id) REFERENCES products(id)
   );
   ```

3. **Configure database connection**
   - Update `db.php` with your database credentials if needed
   - Default configuration:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "ecommerce_db";
     ```

4. **Add sample products**
   ```sql
   INSERT INTO products (name, description, price, image, is_featured) VALUES
   ('Product 1', 'Sample product description', 99.99, 'brain.jpg', 1),
   ('Product 2', 'Another product', 49.99, 'aman.jpg', 0),
   ('Product 3', 'Third product', 79.99, 'raja.jpg', 0);
   ```

5. **Place product images**
   - Add product images to the `images/` directory
   - Supported images: `brain.jpg`, `aman.jpg`, `raja.jpg`

6. **Access the application**
   - Copy the project folder to your XAMPP `htdocs` directory
   - Open your browser and navigate to: `http://localhost/ecommerce/`
   - Start with registration: `http://localhost/ecommerce/register.php`

## File Structure

```
ecommerce/
├── buy.php              # Product listing and add to cart
├── buy_product.php      # Direct product purchase
├── cart.php             # Shopping cart management
├── dashboard.php        # Main dashboard with featured products
├── db.php               # Database connection configuration
├── login.php            # User login
├── logout.php           # User logout
├── orders.php           # Order history
├── register.php         # User registration
├── style.css            # Global stylesheet
├── test_db.php          # Database connection test
├── images/              # Product images directory
│   ├── brain.jpg
│   ├── aman.jpg
│   └── raja.jpg
└── README.md            # This file
```

## Usage

### For Users

1. **Register an account**
   - Navigate to `register.php`
   - Enter username, email, and password
   - Click "Register"

2. **Login**
   - Go to `login.php`
   - Enter your email and password
   - Click "Login"

3. **Browse products**
   - After login, you'll see the dashboard with featured products
   - Click "Buy Products" to view all available items

4. **Add to cart**
   - Browse products on the `buy.php` page
   - Click "Add to Cart" for desired items
   - View your cart at `cart.php`

5. **Make a purchase**
   - Click "Buy Now" on any product for direct purchase
   - Or checkout from your cart

6. **Rate products**
   - Go to your cart
   - Select a rating (1-5 stars) for purchased items
   - Submit your rating

## Database Schema

The application uses four main tables:

- **users**: Stores user account information
- **products**: Contains product details and pricing
- **ratings**: Manages product ratings by users
- **orders**: Tracks purchase history

## Security Features

- Password hashing using PHP's `password_hash()` function
- Session-based authentication
- Login requirement for protected pages
- SQL parameterization (should be improved with prepared statements)

## Future Improvements

- Implement prepared statements to prevent SQL injection
- Add payment gateway integration
- Implement order confirmation emails
- Add admin panel for product management
- Improve error handling and validation
- Add password recovery functionality
- Implement product search and filtering
- Add wishlist feature

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open source and available for educational purposes.

## Contact

For any questions or issues, please open an issue on the GitHub repository.
