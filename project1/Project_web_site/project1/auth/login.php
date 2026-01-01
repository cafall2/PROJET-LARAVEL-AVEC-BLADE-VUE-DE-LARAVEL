<?php
require_once '../config/config.php';
$pageTitle = 'Connexion - ' . SITE_NAME;

if (isLoggedIn()) {
    redirect('/index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $db->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['nom'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['is_admin'] = $user['is_admin'];

            setMessage('Connexion réussie ! Bienvenue ' . $user['nom']);
            redirect('/index.php');
        } else {
            setMessage('Mot de passe incorrect', 'error');
        }
    } else {
        setMessage('Email non trouvé', 'error');
    }
}

include '../includes/header.php';
?>

<div class="min-h-screen flex items-center justify-center py-12">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
            Connexion
        </h2>

        <form method="POST" class="mt-8 space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input id="password" name="password" type="password" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                Se connecter
            </button>

            <p class="text-center text-sm">
                Pas de compte ? <a href="/auth/register.php" class="text-blue-600 hover:underline">S'inscrire</a>
            </p>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
