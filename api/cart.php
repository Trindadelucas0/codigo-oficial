<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit();
}

switch ($data['action']) {
    case 'add':
        $stmt = $pdo->prepare("
            INSERT INTO cart (user_id, product_id, quantity)
            VALUES (?, ?, 1)
            ON DUPLICATE KEY UPDATE quantity = quantity + 1
        ");
        $stmt->execute([$_SESSION['user_id'], $data['product_id']]);
        break;

    case 'increase':
        $stmt = $pdo->prepare("
            UPDATE cart 
            SET quantity = quantity + 1 
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$data['id'], $_SESSION['user_id']]);
        break;

    case 'decrease':
        $stmt = $pdo->prepare("
            UPDATE cart 
            SET quantity = GREATEST(1, quantity - 1)
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$data['id'], $_SESSION['user_id']]);
        break;

    case 'remove':
        $stmt = $pdo->prepare("
            DELETE FROM cart 
            WHERE id = ? AND user_id = ?
        ");
        $stmt->execute([$data['id'], $_SESSION['user_id']]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        exit();
}

echo json_encode(['success' => true]);