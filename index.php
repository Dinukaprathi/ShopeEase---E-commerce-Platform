<?php
// Start session if needed for cart functionality
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get total items in cart
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Store</title>
    <link rel="stylesheet" href="homepage-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .product:hover {
            transform: translateY(-5px);
        }
        
        .product img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
        }
        
        .quantity-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }
        
        .quantity-controls button {
            padding: 0.25rem 0.5rem;
            border: 1px solid #ddd;
            background: #f8f8f8;
            cursor: pointer;
        }
        
        .quantity-controls input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            padding: 0.25rem;
        }
        
        .add-to-cart-button {
            background: #FF6C0C;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }
        
        .add-to-cart-button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <section class="hero">
        <h1>Discover the Best Deals Online</h1>
        <p>Shop the latest trends at unbeatable prices.</p>
        <a href="#featured" class="btn">Shop Now</a>
    </section>

    <section class="categories" id="categories">
        <h2>Shop by Category</h2>
        <div class="category-grid">
            <div class="category">Electronics</div>
            <div class="category">Fashion</div>
            <div class="category">Home & Kitchen</div>
            <div class="category">Sports & Outdoors</div>
            <div class="category">Books</div>
        </div>
    </section>

    <section class="featured" id="featured">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <div class="product" data-id="1" data-name="Wireless Headphones" data-price="99.99">
                <img src="./images/wireless.png" alt="Wireless Headphones">
                <h3>Wireless Headphones</h3>
                <p>$99.99</p>
                <div class="quantity-controls">
                    <button type="button" onclick="updateQuantity(1, -1)">-</button>
                    <input id="quantity-1" type="number" value="1" min="1" readonly>
                    <button type="button" onclick="updateQuantity(1, 1)">+</button>
                </div>
                <button class="add-to-cart-button" onclick="addToCart(1)">Add to Cart</button>
            </div>

            <div class="product" data-id="2" data-name="Smart Watch" data-price="199.99">
                <img src="./images/smart-watch.png" alt="Smart Watch">
                <h3>Smart Watch</h3>
                <p>$199.99</p>
                <div class="quantity-controls">
                    <button type="button" onclick="updateQuantity(2, -1)">-</button>
                    <input id="quantity-2" type="number" value="1" min="1" readonly>
                    <button type="button" onclick="updateQuantity(2, 1)">+</button>
                </div>
                <button class="add-to-cart-button" onclick="addToCart(2)">Add to Cart</button>
            </div>

            <div class="product" data-id="3" data-name="Bluetooth Speaker" data-price="79.99">
                <img src="./images/bspeaker.png" alt="Bluetooth Speaker">
                <h3>Bluetooth Speaker</h3>
                <p>$79.99</p>
                <div class="quantity-controls">
                    <button type="button" onclick="updateQuantity(3, -1)">-</button>
                    <input id="quantity-3" type="number" value="1" min="1" readonly>
                    <button type="button" onclick="updateQuantity(3, 1)">+</button>
                </div>
                <button class="add-to-cart-button" onclick="addToCart(3)">Add to Cart</button>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 ShopEase. All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateCartCount() {
            $.ajax({
                url: 'get_cart_count.php',
                method: 'GET',
                success: function(response) {
                    $('.cart-count').text(response);
                }
            });
        }

        function addToCart(productId) {
            const quantity = parseInt($(`#quantity-${productId}`).val());
            
            $.ajax({
                url: 'add_to_cart.php',
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    updateCartCount();
                    alert('Product added to cart!');
                },
                error: function() {
                    alert('Error adding product to cart');
                }
            });
        }

        function updateQuantity(productId, change) {
            const input = $(`#quantity-${productId}`);
            const currentValue = parseInt(input.val());
            const newValue = currentValue + change;
            
            if (newValue >= 1) {
                input.val(newValue);
            }
        }
    </script>
</body>
</html>
