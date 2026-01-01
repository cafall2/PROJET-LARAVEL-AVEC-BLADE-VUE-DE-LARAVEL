<?php
require_once '../config.php';

$conn = getDBConnection();
$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    if ($action === 'register') {
        $nom = $conn->real_escape_string($data['nom']);
        $email = $conn->real_escape_string($data['email']);
        $password = $data['password'];
        $telephone = $conn->real_escape_string($data['telephone']);

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $checkEmail = $conn->query("SELECT id FROM users WHERE email = '$email'");
        if ($checkEmail->num_rows > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Cet email est déjà utilisé'
            ]);
            exit();
        }

        $sql = "INSERT INTO users (nom, email, mot_de_passe, telephone) VALUES ('$nom', '$email', '$hashedPassword', '$telephone')";

        if ($conn->query($sql)) {
            $userId = $conn->insert_id;
            $user = $conn->query("SELECT id, nom, email, telephone, is_admin FROM users WHERE id = $userId")->fetch_assoc();

            $_SESSION['user_id'] = $userId;
            $_SESSION['user'] = $user;

            echo json_encode([
                'success' => true,
                'user' => $user
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Erreur lors de l\'inscription'
            ]);
        }
    } elseif ($action === 'login') {
        $email = $conn->real_escape_string($data['email']);
        $password = $data['password'];

        $result = $conn->query("SELECT * FROM users WHERE email = '$email'");

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['mot_de_passe'])) {
                $_SESSION['user_id'] = $user['id'];
                unset($user['mot_de_passe']);
                $_SESSION['user'] = $user;

                echo json_encode([
                    'success' => true,
                    'user' => $user
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Mot de passe incorrect'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Email non trouvé'
            ]);
        }
    } elseif ($action === 'logout') {
        session_destroy();
        echo json_encode([
            'success' => true,
            'message' => 'Déconnexion réussie'
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => true,
            'user' => $_SESSION['user']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'user' => null
        ]);
    }
}

$conn->close();
?>
