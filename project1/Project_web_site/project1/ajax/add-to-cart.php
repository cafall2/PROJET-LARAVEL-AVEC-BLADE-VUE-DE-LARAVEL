<?php
session_start();
require_once '../config/database.php';

$productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if (!$productId || $quantity < 1) {
    header('Location: /boutique.php');
    exit;
}

$db = getDB();
$query = "SELECT * FROM products WHERE id = $productId";
$result = $db->query($query);

if (!$result || $result->num_rows === 0) {
    header('Location: /boutique.php');
    exit;
}

$product = $result->fetch_assoc();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $productId) {
        $item['quantity'] += $quantity;
        $found = true;
        break;
    }
}

if (!$found) {
    $_SESSION['cart'][] = [
        'id' => $product['id'],
        'nom' => $product['nom'],
        'prix' => $product['prix'],
        'image_url' => $product['image_url'],
        'quantity' => $quantity
    ];
}

$_SESSION['message'] = 'Produit ajouté au panier';
$_SESSION['message_type'] = 'success';

header('Location: /panier.php');
exit;
