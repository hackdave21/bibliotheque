<?php
include 'configuration_database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_livre'], $_POST['id_lecteur'])) {
    $id_livre = $_POST['id_livre'];
    $id_lecteur = $_POST['id_lecteur'];
    $stmt = $conn->prepare("INSERT INTO liste_lecture (id_livre, id_lecteur) VALUES (?, ?)");
    $stmt->bind_param("ii", $id_livre, $id_lecteur);
    $stmt->execute();
}

// Afficher la liste de lecture
if (isset($_GET['id_lecteur'])) {
    $id_lecteur = $_GET['id_lecteur'];
    $stmt = $conn->prepare("SELECT livres.titre, livres.auteur FROM liste_lecture JOIN livres ON liste_lecture.id_livre = livres.id WHERE liste_lecture.id_lecteur = ?");
    $stmt->bind_param("i", $id_lecteur);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['titre'] . " - " . $row['auteur'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Votre liste de lecture est vide.</p>";
    }
}
?>