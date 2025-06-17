<?php
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Calculate total items in cart
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));

// Return the count
echo $cartCount;
?> 