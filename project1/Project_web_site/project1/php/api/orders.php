<?php
require_once '../config.php';

$conn = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Non authentifié'
        ]);
        exit();
    }

    $userId = (int)$_SESSION['user_id'];
    $isAdmin = $_SESSION['user']['is_admin'];

    if ($isAdmin) {
        $sql = "SELECT o.*, u.nom as user_nom FROM orders o
                LEFT JOIN users u ON o.user_id = u.id
                ORDER BY o.created_at DESC";
    } else {
        $sql = "SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC";
    }

    $result = $conn->query($sql);
    $orders = [];

    while ($row = $result->fetch_assoc()) {
        $row['id'] = (string)$row['id'];
        $row['total'] = (float)$row['total'];
        $orders[] = $row;
    }

    echo json_encode([
        'success' => true,
        'data' => $orders
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Non authentifié'
        ]);
        exit();
    }

    $data = json_decode(file_get_contents('php://input'), true);

    $userId = (int)$_SESSION['user_id'];
    $total = (float)$data['total'];
    $paymentMethod = $conn->real_escape_string($data['payment_method']);
    $items = $data['items'];

    $conn->begin_transaction();

    try {
        $sql = "INSERT INTO orders (user_id, total, payment_method, payment_status, statut)
                VALUES ($userId, $total, '$paymentMethod', 'pending', 'pending')";

        if (!$conn->query($sql)) {
            throw new Exception('Erreur lors de la création de la commande');
        }

        $orderId = $conn->insert_id;

        foreach ($items as $item) {
            $productId = (int)$item['product_id'];
            $quantity = (int)$item['quantity'];
            $prixUnitaire = (float)$item['prix_unitaire'];

            $itemSql = "INSERT INTO order_items (order_id, product_id, quantity, prix_unitaire)
                        VALUES ($orderId, $productId, $quantity, $prixUnitaire)";

            if (!$conn->query($itemSql)) {
                throw new Exception('Erreur lors de l\'ajout des articles');
            }
        }

        $paymentSuccess = rand(1, 10) > 2;

        if ($paymentSuccess) {
            $updateSql = "UPDATE orders SET payment_status = 'success', statut = 'paid' WHERE id = $orderId";
        } else {
            $updateSql = "UPDATE orders SET payment_status = 'failed' WHERE id = $orderId";
        }

        $conn->query($updateSql);

        $conn->commit();

        echo json_encode([
            'success' => true,
            'order_id' => $orderId,
            'payment_success' => $paymentSuccess
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
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

    $orderId = (int)$data['id'];
    $statut = $conn->real_escape_string($data['statut']);

    $sql = "UPDATE orders SET statut = '$statut' WHERE id = $orderId";

    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Commande mise à jour avec succès'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erreur lors de la mise à jour de la commande'
        ]);
    }
}

$conn->close();
?>
