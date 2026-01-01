<?php
require_once 'config/config.php';
$pageTitle = 'Commander - ' . SITE_NAME;

if (!isLoggedIn()) {
    redirect('/auth/login.php');
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

if (empty($cart)) {
    redirect('/boutique.php');
}

$total = 0;
foreach ($cart as $item) {
    $total += $item['prix'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    
    if ($paymentMethod) {
        $_SESSION['cart'] = [];
        setMessage('Commande passée avec succès!');
        redirect('/index.php');
    }
}

include 'includes/header.php';
?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Finaliser ma commande</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Mode de paiement</h2>

        <form method="POST">
            <div class="space-y-3 mb-6">
                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="orange_money" class="mr-4" required>
                    <span class="font-medium">Orange Money</span>
                </label>

                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="wave" class="mr-4" required>
                    <span class="font-medium">Wave</span>
                </label>
            </div>

            <div class="border-t pt-4 mb-6">
                <div class="flex justify-between text-2xl font-bold">
                    <span>Total</span>
                    <span class="text-blue-600"><?php echo formatPrice($total); ?></span>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold text-lg">
                Confirmer la commande
            </button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
