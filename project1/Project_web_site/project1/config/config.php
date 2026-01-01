<?php
session_start();

define('SITE_NAME', 'E-Shop Sénégal');
define('SITE_URL', 'http://localhost');
define('CURRENCY', 'CFA');

define('ROOT_PATH', dirname(__DIR__));
define('ASSETS_PATH', SITE_URL . '/assets');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function setMessage($message, $type = 'success') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

function getMessage() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $type = $_SESSION['message_type'] ?? 'success';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        return ['message' => $message, 'type' => $type];
    }
    return null;
}

function formatPrice($price) {
    return number_format($price, 0, ',', ' ') . ' ' . CURRENCY;
}

require_once ROOT_PATH . '/config/database.php';
?>
