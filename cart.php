<?php
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Product database (in a real application, this would come from a database)
$products = [
    1 => ['name' => 'Wireless Headphones', 'price' => 99.99, 'image' => './images/wireless.png'],
    2 => ['name' => 'Smart Watch', 'price' => 199.99, 'image' => './images/smart-watch.png'],
    3 => ['name' => 'Bluetooth Speaker', 'price' => 79.99, 'image' => './images/bspeaker.png']
];

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $product_id => $item) {
    if (isset($products[$product_id])) {
        $total += $products[$product_id]['price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - ShopEase</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .cart-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .cart-header {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .cart-header h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .cart-items {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .cart-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 2rem;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s ease;
        }

        .cart-item:hover {
            background-color: #f9f9f9;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .cart-item-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .cart-item-details h3 {
            font-size: 1.2rem;
            color: #333;
        }

        .cart-item-price {
            font-size: 1.1rem;
            color: #4CAF50;
            font-weight: bold;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .quantity-controls button {
            width: 30px;
            height: 30px;
            border: none;
            background: #f0f0f0;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .quantity-controls button:hover {
            background: #e0e0e0;
        }

        .quantity-controls input {
            width: 50px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 0.5rem;
            font-size: 1rem;
        }

        .remove-item {
            color: #ff4444;
            cursor: pointer;
            font-size: 1.5rem;
            transition: color 0.3s ease;
            padding: 0.5rem;
        }

        .remove-item:hover {
            color: #cc0000;
        }

        .cart-summary {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .cart-summary h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .summary-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .cart-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        #clear-cart {
            padding: 0.8rem 1.5rem;
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        #clear-cart:hover {
            background: #e0e0e0;
        }

        .checkout-button {
            padding: 0.8rem 1.5rem;
            background: #FF6C0C;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkout-button:hover {
            background: darkorange; 
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-cart i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 1rem;
        }

        .empty-cart p {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .continue-shopping {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background: #FF6C0C;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .continue-shopping:hover {
            background: orange;
        }

        @media (max-width: 768px) {
            .cart-item {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 1rem;
            }

            .cart-item img {
                margin: 0 auto;
            }

            .quantity-controls {
                justify-content: center;
            }

            .cart-actions {
                flex-direction: column;
            }

            .checkout-button, #clear-cart {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
        }

        header {
            display: flex;
            align-items: center;
            background: var(--primary-blue, #12195F);
            padding: 0 50px;
            color: #fff;
            position: relative;
            min-height: 60px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="cart-container">
        <div class="cart-header">
            <h2><i class="fas fa-shopping-cart"></i> Your Shopping Cart</h2>
        </div>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-basket"></i>
                <p>Your cart is empty</p>
                <a href="index.php" class="continue-shopping">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                    <?php if (isset($products[$product_id])): ?>
                        <div class="cart-item" data-id="<?php echo $product_id; ?>">
                            <img src="<?php echo $products[$product_id]['image']; ?>" alt="<?php echo $products[$product_id]['name']; ?>">
                            <div class="cart-item-details">
                                <h3><?php echo $products[$product_id]['name']; ?></h3>
                                <p class="cart-item-price">$<?php echo number_format($products[$product_id]['price'], 2); ?></p>
                                <div class="quantity-controls">
                                    <button onclick="updateCartQuantity(<?php echo $product_id; ?>, -1)">-</button>
                                    <input type="number" value="<?php echo $item['quantity']; ?>" min="1" readonly>
                                    <button onclick="updateCartQuantity(<?php echo $product_id; ?>, 1)">+</button>
                                </div>
                            </div>
                            <span class="remove-item" onclick="removeFromCart(<?php echo $product_id; ?>)">
                                <i class="fas fa-trash"></i>
                            </span>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Free</span>
                </div>
                <div class="summary-row">
                    <span>Total</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
                <div class="cart-actions">
                    <button id="clear-cart" onclick="clearCart()">
                        <i class="fas fa-trash"></i> Clear Cart
                    </button>
                    <a href="payment-gateway.php" class="checkout-button">
                        <i class="fas fa-lock"></i> Proceed to Checkout
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        function updateCartQuantity(productId, change) {
            $.ajax({
                url: 'update_cart.php',
                method: 'POST',
                data: {
                    product_id: productId,
                    change: change
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
        
        function removeFromCart(productId) {
            if (confirm('Are you sure you want to remove this item?')) {
                $.ajax({
                    url: 'remove_from_cart.php',
                    method: 'POST',
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
        
        function clearCart() {
            if (confirm('Are you sure you want to clear your cart?')) {
                $.ajax({
                    url: 'clear_cart.php',
                    method: 'POST',
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>
