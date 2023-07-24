<?php
session_start();

if (empty($_SESSION['login'])) {
    header('Location:login.php');
    exit();
}

$user_id = $_SESSION['login']['User_id'];

if (isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];
    if (isset($_SESSION["cart"][$user_id][$product_id])) {
        unset($_SESSION["cart"][$user_id][$product_id]);
        if (empty($_SESSION["cart"][$user_id])) {
            unset($_SESSION["cart"][$user_id]);
        }
        // exit();
    } else {
        echo "Product not found in cart!";
    }
} else {
    echo "Product ID not specified!";
}
