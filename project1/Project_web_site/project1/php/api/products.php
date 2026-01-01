<?php
require_once '../config.php';

$conn = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $row['id'] = (string)$row['id'];
        $row['prix'] = (float)$row['prix'];
        $row['stock'] = (int)$row['stock'];
        $products[] = $row;
    }

    echo json_encode([
        'success' => true,
        'data' => $products
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id']) || !$_SESSION['user']['is_admin']) {
        echo json_encode([
            'success' => false,
            'message' => 'Non autorisé'
        ]);
        exit();
    }

    $data = json_decode(file_get_contents('php://input'), true);

    $nom = $conn->real_escape_string($data['nom']);
    $description = $conn->real_escape_string($data['description']);
    $prix = (float)$data['prix'];
    $image_url = $conn->real_escape_string($data['image_url']);
    $categorie = $conn->real_escape_string($data['categorie']);
    $stock = (int)$data['stock'];

    $sql = "INSERT INTO products (nom, description, prix, image_url, categorie, stock)
            VALUES ('$nom', '$description', $prix, '$image_url', '$categorie', $stock)";

    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Produit ajouté avec succès'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de l\'ajout du produit'
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (!isset($_SESSION['user_id']) || !$_SESSION['user']['is_admin']) {
        echo json_encode([
            'success' => false,
            'message' => 'Non autorisé'
        ]);
        exit();
    }

    $data = json_decode(file_get_contents('php://input'), true);

    $id = (int)$data['id'];
    $nom = $conn->real_escape_string($data['nom']);
    $description = $conn->real_escape_string($data['description']);
    $prix = (float)$data['prix'];
    $image_url = $conn->real_escape_string($data['image_url']);
    $categorie = $conn->real_escape_string($data['categorie']);
    $stock = (int)$data['stock'];

    $sql = "UPDATE products SET
            nom = '$nom',
            description = '$description',
            prix = $prix,
            image_url = '$image_url',
            categorie = '$categorie',
            stock = $stock
            WHERE id = $id";

    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Produit modifié avec succès'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la modification du produit'
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (!isset($_SESSION['user_id']) || !$_SESSION['user']['is_admin']) {
        echo json_encode([
            'success' => false,
            'message' => 'Non autorisé'
        ]);
        exit();
    }

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    $sql = "DELETE FROM products WHERE id = $id";

    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Produit supprimé avec succès'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la suppression du produit'
        ]);
    }
}

$conn->close();
?>
