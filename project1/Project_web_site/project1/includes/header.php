<?php
if (!defined('ROOT_PATH')) {
    require_once __DIR__ . '/../config/config.php';
}
$db = getDB();
$cartCount = 0;

if (isset($_SESSION['cart'])) {
    $cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? SITE_NAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/index.php" class="text-2xl font-bold text-blue-600">
                        <?php echo SITE_NAME; ?>
                    </a>
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="/index.php" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            Accueil
                        </a>
                        <a href="/boutique.php" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            Boutique
                        </a>
                        <a href="/contact.php" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            Contact
                        </a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="/panier.php" class="relative text-gray-700 hover:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <?php if ($cartCount > 0): ?>
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                <?php echo $cartCount; ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <?php if (isLoggedIn()): ?>
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span><?php echo $_SESSION['user_nom'] ?? 'Mon compte'; ?></span>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden group-hover:block">
                                <?php if (isAdmin()): ?>
                                    <a href="/admin/index.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Administration
                                    </a>
                                <?php endif; ?>
                                <a href="/auth/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Déconnexion
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/auth/login.php" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                            Connexion
                        </a>
                        <a href="/auth/register.php" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                            S'inscrire
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <?php
    $msg = getMessage();
    if ($msg):
    ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-<?php echo $msg['type'] === 'error' ? 'red' : 'green'; ?>-100 border border-<?php echo $msg['type'] === 'error' ? 'red' : 'green'; ?>-400 text-<?php echo $msg['type'] === 'error' ? 'red' : 'green'; ?>-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($msg['message']); ?></span>
            </div>
        </div>
    <?php endif; ?>

    <main>
