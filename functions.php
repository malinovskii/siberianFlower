<?php
session_start();


// Require database connection 
require_once './database/DBController.php';
require_once './database/classes/Product.php';
require_once './database/classes/Cart.php';

// DBController object
$db = new DBController(); 

// Product object
$product = new Product($db);

// Cart object
$Cart = new Cart($db);

// Basic arrays
$product_array = $product->getDataFromTable('product');


// Calculate subtotal
foreach ($_SESSION['cart'] ?? [] as $item){
    $cart = $product->getProductById($item);
    $subtotal[] = array_map(function ($product) {
        return $product['price'];
    }, $cart);
}


if(!empty($_SESSION['cart'])){
    // Subtotal in cart
    $_SESSION['subtotal'] = $Cart->calculateSubtotal($subtotal);
} else {
    $_SESSION['subtotal'] = 0;
}
