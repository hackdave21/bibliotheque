<?php
include __DIR__ . '/db.php';
$conn = connectDB();

// Ajouter un nouveau livre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titre'], $_POST['auteur'], $_POST['description'], $_POST['maison_edition'], $_POST['nombre_exemplaire']) && !isset($_POST['id'])) {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $description = $_POST['description'];
    $maisonEdition = $_POST['maison_edition'];
    $nombreExemplaire = $_POST['nombre_exemplaire'];

    $stmt = $conn->prepare("INSERT INTO livres (titre, auteur, description, maison_edition, nombre_exemplaire) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $titre);
    $stmt->bindParam(2, $auteur);
    $stmt->bindParam(3, $description);
    $stmt->bindParam(4, $maisonEdition);
    $stmt->bindParam(5, $nombreExemplaire);
    $stmt->execute();

    // Rediriger vers la page principale avec la section voir-tout active
    header("Location: ../index.php#voir-tout");
    exit();
}

// Mettre à jour un livre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['titre'], $_POST['auteur'], $_POST['description'], $_POST['maison_edition'], $_POST['nombre_exemplaire'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $description = $_POST['description'];
    $maisonEdition = $_POST['maison_edition'];
    $nombreExemplaire = $_POST['nombre_exemplaire'];

    $stmt = $conn->prepare("UPDATE livres SET titre = ?, auteur = ?, description = ?, maison_edition = ?, nombre_exemplaire = ? WHERE id = ?");
    $stmt->bindParam(1, $titre);
    $stmt->bindParam(2, $auteur);
    $stmt->bindParam(3, $description);
    $stmt->bindParam(4, $maisonEdition);
    $stmt->bindParam(5, $nombreExemplaire);
    $stmt->bindParam(6, $id);
    $stmt->execute();

    // Rediriger vers la page principale avec la section voir-tout active
    header("Location: ../index.php#voir-tout");
    exit();
}

// Supprimer un livre
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM livres WHERE id = ?");
    $stmt->bindParam(1, $id);
    $stmt->execute();

    echo "Le livre a été supprimé avec succès.";
    exit();
}
?>