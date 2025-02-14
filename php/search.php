<?php
require_once 'configuration_database.php';

function searchBooks($search) {
    $conn = connectDB();
    $search = "%$search%";
    
    $query = "SELECT * FROM livres WHERE titre LIKE :search OR auteur LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':search', $search);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$searchResults = [];
if (isset($_GET['search'])) {
    $searchResults = searchBooks($_GET['search']);
}
?>