<?php
require_once '../config/config.php';
$pageTitle = 'Administration - ' . SITE_NAME;

if (!isAdmin()) {
    redirect('/index.php');
}

$db = getDB();

$statsQuery = "SELECT
    (SELECT COUNT(*) FROM products) as total_products,
    (SELECT COUNT(*) FROM orders) as total_orders,
    (SELECT COUNT(*) FROM users) as total_users";
$statsResult = $db->query($statsQuery);
$stats = $statsResult->fetch_assoc();

include '../includes/header.php';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Tableau de bord Administration</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Produits</h3>
            <p class="text-3xl font-bold text-blue-600"><?php echo $stats['total_products']; ?></p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Commandes</h3>
            <p class="text-3xl font-bold text-green-600"><?php echo $stats['total_orders']; ?></p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-2">Utilisateurs</h3>
            <p class="text-3xl font-bold text-purple-600"><?php echo $stats['total_users']; ?></p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
