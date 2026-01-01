<?php
require_once '../config/config.php';
$pageTitle = 'Inscription - ' . SITE_NAME;

if (isLoggedIn()) {
    redirect('/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $db->real_escape_string($_POST['nom']);
    $email = $db->real_escape_string($_POST['email']);
    $telephone = $db->real_escape_string($_POST['telephone']);
    $password = $_POST['password'];

    $checkQuery = "SELECT id FROM users WHERE email = '$email'";
    $checkResult = $db->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        setMessage('Cet email est déjà utilisé', 'error');
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO users (nom, email, telephone, mot_de_passe, is_admin) VALUES ('$nom', '$email', '$telephone', '$hashedPassword', 0)";

        if ($db->query($insertQuery)) {
            $userId = $db->insert_id;
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_nom'] = $nom;
            $_SESSION['user_email'] = $email;
            $_SESSION['is_admin'] = 0;

            setMessage('Inscription réussie ! Bienvenue ' . $nom);
            redirect('/index.php');
        } else {
            setMessage('Erreur lors de l\'inscription', 'error');
        }
    }
}

include '../includes/header.php';
?>

<div class="min-h-screen flex items-center justify-center py-12">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
            Inscription
        </h2>

        <form method="POST" class="mt-8 space-y-6">
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                <input id="nom" name="nom" type="text" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input id="telephone" name="telephone" type="tel" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input id="password" name="password" type="password" required minlength="6"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                S'inscrire
            </button>

            <p class="text-center text-sm">
                Déjà un compte ? <a href="/auth/login.php" class="text-blue-600 hover:underline">Se connecter</a>
            </p>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
