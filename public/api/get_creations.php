<?php
require_once '../../config/database.php';

try {
    $stmt = $pdo->query("SELECT id, cover AS image, title AS alt, CONCAT('details-creation.php?id=', id) AS link FROM portfolio");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur BDD : ' . $e->getMessage()]);
}
