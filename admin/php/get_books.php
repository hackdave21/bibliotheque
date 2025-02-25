<?php
include __DIR__ . '/db.php';
header('Content-Type: application/json');

try {
    $livres = getLivres();
    echo json_encode($livres);
} catch(Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>