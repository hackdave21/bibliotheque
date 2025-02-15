<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $idLivre = intval($_GET['id']);
    $conn = connectDB();
    
    $stmt = $conn->prepare("SELECT * FROM livres WHERE id = ?");
    $stmt->bindValue(1, $idLivre, PDO::PARAM_INT);
    $stmt->execute();
    $livre = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($livre) {
        echo "<h2>Détails du livre</h2>
              <div class='livre-details'>
                  <h3>" . htmlspecialchars($livre['titre']) . "</h3>
                  <p><strong>Auteur :</strong> " . htmlspecialchars($livre['auteur']) . "</p>
                  <p><strong>Description :</strong> " . htmlspecialchars($livre['description']) . "</p>
                  <p><strong>Maison d'édition :</strong> " . htmlspecialchars($livre['maison_edition']) . "</p>
                  <p><strong>Exemplaires disponibles :</strong> " . htmlspecialchars($livre['nombre_exemplaire']) . "</p>
                 
              </div>";
    } else {
        echo "<p>Livre introuvable.</p>";
    }
}
?>
