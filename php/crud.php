<?php
include 'configuration_database.php';

// Ajouter un nouveau livre
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titre'], $_POST['auteur'], $_POST['description'], $_POST['maison_edition'], $_POST['nombre_exemplaire'])) {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $description = $_POST['description'];
    $maisonEdition = $_POST['maison_edition'];
    $nombreExemplaire = $_POST['nombre_exemplaire'];

    $stmt = $conn->prepare("INSERT INTO livres (titre, auteur, description, maison_edition, nombre_exemplaire) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $titre, $auteur, $description, $maisonEdition, $nombreExemplaire);
    $stmt->execute();

    echo "Le livre a été ajouté avec succès.";
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
    $stmt->bind_param("ssssii", $titre, $auteur, $description, $maisonEdition, $nombreExemplaire, $id);
    $stmt->execute();

    echo "Le livre a été mis à jour avec succès.";
}

// Supprimer un livre
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM livres WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Le livre a été supprimé avec succès.";
}
?>