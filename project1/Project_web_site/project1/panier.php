<?php
require_once 'config/config.php';
$pageTitle = 'Mon Panier - ' . SITE_NAME;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'remove' && isset($_POST['product_id'])) {
            $productId = (int)$_POST['product_id'];
            $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($productId) {
                return $item['id'] != $productId;
            });
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        } elseif ($_POST['action'] === 'clear') {
            $_SESSION['cart'] = [];
        }
    }
    redirect('/panier.php');
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['prix'] * $item['quantity'];
}

include 'includes/header.php';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Mon Panier</h1>

    <?php if (empty($cart)): ?>
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <p class="text-gray-500 text-xl mb-6">Votre panier est vide</p>
            <a href="/boutique.php" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Continuer mes achats
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <?php foreach ($cart as $item): ?>
                        <div class="flex items-center border-b p-6">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>"
                                 alt="<?php echo htmlspecialchars($item['nom']); ?>"
                                 class="w-24 h-24 object-cover rounded">

                            <div class="flex-1 ml-6">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <?php echo htmlspecialchars($item['nom']); ?>
                                </h3>
                                <p class="text-blue-600 font-bold mt-1">
                                    <?php echo formatPrice($item['prix']); ?>
                                </p>
                                <p class="text-sm text-gray-600">Quantité: <?php echo $item['quantity']; ?></p>
                            </div>

                            <div class="flex items-center space-x-4">
                                <span class="text-lg font-bold text-gray-900">
                                    <?php echo formatPrice($item['prix'] * $item['quantity']); ?>
                                </span>

                                <form method="POST">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-4">Résumé</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Sous-total</span>
                            <span><?php echo formatPrice($total); ?></span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-blue-600"><?php echo formatPrice($total); ?></span>
                        </div>
                    </div>

                    <?php if (isLoggedIn()): ?>
                        <a href="/commande.php" class="block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Commander
                        </a>
                    <?php else: ?>
                        <a href="/auth/login.php" class="block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                            Connexion pour commander
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
