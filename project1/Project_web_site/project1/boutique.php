<?php
require_once 'config/config.php';
$pageTitle = 'Boutique - ' . SITE_NAME;
$db = getDB();

$categoryFilter = isset($_GET['categorie']) ? $db->real_escape_string($_GET['categorie']) : '';
$searchQuery = isset($_GET['search']) ? $db->real_escape_string($_GET['search']) : '';

$query = "SELECT * FROM products WHERE 1=1";

if ($categoryFilter) {
    $query .= " AND categorie = '$categoryFilter'";
}

if ($searchQuery) {
    $query .= " AND (nom LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
}

$query .= " ORDER BY created_at DESC";

$result = $db->query($query);
$products = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$categoriesQuery = "SELECT DISTINCT categorie FROM products ORDER BY categorie";
$categoriesResult = $db->query($categoriesQuery);
$categories = [];
if ($categoriesResult) {
    while ($row = $categoriesResult->fetch_assoc()) {
        $categories[] = $row['categorie'];
    }
}

include 'includes/header.php';
?>

<div class="bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Notre Boutique</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Catégories</h2>
                    <ul class="space-y-2">
                        <li>
                            <a href="/boutique.php" class="block px-3 py-2 rounded <?php echo !$categoryFilter ? 'bg-blue-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100'; ?>">
                                Toutes les catégories
                            </a>
                        </li>
                        <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="/boutique.php?categorie=<?php echo urlencode($cat); ?>"
                                   class="block px-3 py-2 rounded <?php echo $categoryFilter === $cat ? 'bg-blue-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100'; ?>">
                                    <?php echo htmlspecialchars($cat); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>

            <div class="lg:w-3/4">
                <div class="mb-6">
                    <p class="text-gray-600">
                        <?php echo count($products); ?> produit(s) trouvé(s)
                    </p>
                </div>

                <?php if (empty($products)): ?>
                    <div class="bg-white rounded-lg shadow-md p-12 text-center">
                        <p class="text-gray-500 text-lg">Aucun produit ne correspond à vos critères.</p>
                        <a href="/boutique.php" class="inline-block mt-4 text-blue-600 hover:underline">
                            Voir tous les produits
                        </a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($products as $product): ?>
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                                <a href="/produit.php?id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
                                         alt="<?php echo htmlspecialchars($product['nom']); ?>"
                                         class="w-full h-64 object-cover">
                                </a>
                                <div class="p-4">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-2">
                                        <?php echo htmlspecialchars($product['categorie']); ?>
                                    </span>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        <a href="/produit.php?id=<?php echo $product['id']; ?>" class="hover:text-blue-600">
                                            <?php echo htmlspecialchars($product['nom']); ?>
                                        </a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-blue-600">
                                            <?php echo formatPrice($product['prix']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
