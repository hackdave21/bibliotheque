<?php
include 'configuration_database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM livres WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row['titre'] . "</h2>";
        echo "<p><strong>Auteur :</strong> " . $row['auteur'] . "</p>";
        echo "<p><strong>Description :</strong> " . $row['description'] . "</p>";
        echo "<p><strong>Maison d'édition :</strong> " . $row['maison_edition'] . "</p>";
        echo "<p><strong>Exemplaires disponibles :</strong> " . $row['nombre_exemplaire'] . "</p>";
    } else {
        echo "<p>Livre non trouvé.</p>";
    }
}
?>