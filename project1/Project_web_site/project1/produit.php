<?php
require_once 'config/config.php';
$db = getDB();

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$productId) {
    redirect('/boutique.php');
}

$query = "SELECT * FROM products WHERE id = $productId";
$result = $db->query($query);

if (!$result || $result->num_rows === 0) {
    redirect('/boutique.php');
}

$product = $result->fetch_assoc();
$pageTitle = htmlspecialchars($product['nom']) . ' - ' . SITE_NAME;

include 'includes/header.php';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <div>
            <img src="<?php echo htmlspecialchars($product['image_url']); ?>"
                 alt="<?php echo htmlspecialchars($product['nom']); ?>"
                 class="w-full rounded-lg shadow-lg">
        </div>

        <div>
            <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full mb-4">
                <?php echo htmlspecialchars($product['categorie']); ?>
            </span>

            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <?php echo htmlspecialchars($product['nom']); ?>
            </h1>

            <div class="flex items-center mb-6">
                <span class="text-4xl font-bold text-blue-600">
                    <?php echo formatPrice($product['prix']); ?>
                </span>
            </div>

            <div class="mb-6">
                <?php if ($product['stock'] > 0): ?>
                    <span class="inline-flex items-center text-green-600">
                        En stock (<?php echo $product['stock']; ?> disponible<?php echo $product['stock'] > 1 ? 's' : ''; ?>)
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center text-red-600">
                        Rupture de stock
                    </span>
                <?php endif; ?>
            </div>

            <div class="prose max-w-none mb-8">
                <h3 class="text-lg font-semibold mb-2">Description</h3>
                <p class="text-gray-600">
                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                </p>
            </div>

            <?php if ($product['stock'] > 0): ?>
                <form method="POST" action="/ajax/add-to-cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="quantity" value="1">

                    <button type="submit"
                            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                        Ajouter au panier
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
