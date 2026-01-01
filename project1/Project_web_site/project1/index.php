<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
require_once 'config/config.php';
$pageTitle = 'Accueil - ' . SITE_NAME;
$db = getDB();

$query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 8";
$result = $db->query($query);
$featuredProducts = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $featuredProducts[] = $row;
    }
}

include 'includes/header.php';
?>

<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Bienvenue sur <?php echo SITE_NAME; ?>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Découvrez nos produits de qualité à des prix imbattables
            </p>
            <a href="/boutique.php" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-100 transition">
                Découvrir la boutique
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Qualité Garantie</h3>
            <p class="text-gray-600">Tous nos produits sont soigneusement sélectionnés</p>
        </div>

        <div class="text-center">
            <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Paiement Sécurisé</h3>
            <p class="text-gray-600">Orange Money & Wave acceptés</p>
        </div>

        <div class="text-center">
            <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Livraison Rapide</h3>
            <p class="text-gray-600">Livraison à Dakar et dans tout le Sénégal</p>
        </div>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-8">Produits en Vedette</h2>

    <?php if (empty($featuredProducts)): ?>
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Aucun produit disponible pour le moment.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    <a href="/produit.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
                             alt="<?php echo htmlspecialchars($product['nom']); ?>"
                             class="w-full h-64 object-cover">
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            <a href="/produit.php?id=<?php echo $product['id']; ?>" class="hover:text-blue-600">
                                <?php echo htmlspecialchars($product['nom']); ?>
                            </a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                            <?php echo htmlspecialchars(substr($product['description'], 0, 80)) . '...'; ?>
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-blue-600">
                                <?php echo formatPrice($product['prix']); ?>
                            </span>
                            <a href="/produit.php?id=<?php echo $product['id']; ?>"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="/boutique.php" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                Voir tous les produits
            </a>
        </div>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
