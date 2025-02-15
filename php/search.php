<?php
// Activer le rapport d'erreurs pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inclure le fichier de configuration de la base de données
require_once 'php/db.php';

// Fonction pour rechercher des livres
function searchBooks($search) {
    $conn = connectDB(); // Connexion à la base de données
    $search = "%$search%"; // Ajouter des wildcards pour la recherche partielle
    
    // Requête SQL pour rechercher par titre ou auteur
    $query = "SELECT * FROM livres WHERE titre LIKE :search OR auteur LIKE :search";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':search', $search);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourner les résultats sous forme de tableau associatif
}

// Vérifier si le paramètre 'query' est présent dans l'URL
if (isset($_GET['query'])) {
    $searchResults = searchBooks($_GET['query']); // Rechercher les livres
} else {
    $searchResults = []; // Aucun résultat si 'query' n'est pas présent
}

// Renvoyer les résultats au format JSON
header('Content-Type: application/json');
echo json_encode($searchResults);
?>