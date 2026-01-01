<?php
require_once 'config/config.php';
$pageTitle = 'Contact - ' . SITE_NAME;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    setMessage('Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.');
    redirect('/contact.php');
}

include 'includes/header.php';
?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Contactez-nous</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form method="POST" class="space-y-6">
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                <input type="text" id="nom" name="nom" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea id="message" name="message" rows="5" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                Envoyer le message
            </button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
