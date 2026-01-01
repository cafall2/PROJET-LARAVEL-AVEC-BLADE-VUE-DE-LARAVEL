    </main>

    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4"><?php echo SITE_NAME; ?></h3>
                    <p class="text-gray-400">
                        Votre boutique en ligne de confiance au Sénégal.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="/index.php" class="text-gray-400 hover:text-white">Accueil</a></li>
                        <li><a href="/boutique.php" class="text-gray-400 hover:text-white">Boutique</a></li>
                        <li><a href="/contact.php" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Compte</h4>
                    <ul class="space-y-2">
                        <?php if (isLoggedIn()): ?>
                            <li><a href="/panier.php" class="text-gray-400 hover:text-white">Mon panier</a></li>
                        <?php else: ?>
                            <li><a href="/auth/login.php" class="text-gray-400 hover:text-white">Connexion</a></li>
                            <li><a href="/auth/register.php" class="text-gray-400 hover:text-white">Inscription</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Paiement</h4>
                    <p class="text-gray-400 mb-2">Nous acceptons:</p>
                    <div class="flex space-x-4">
                        <div class="bg-orange-500 text-white px-3 py-1 rounded text-sm">Orange Money</div>
                        <div class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Wave</div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="/assets/js/script.js"></script>
</body>
</html>
