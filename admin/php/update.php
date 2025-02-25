<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour | Bibliophile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <span>Admin</span>
            </div>
            <div class="user-profile">
                <i class="fas fa-user"></i>
            </div>
        </header>

        <nav class="sidebar" id="sidebar">
            <div class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="menu">
                <li class="menu-item">
                    <a href="index.php#dashboard">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="index.php#ajouter">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter</span>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="index.php#voir-tout">
                        <i class="fas fa-list"></i>
                        <span>Voir tout</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content">
                <h1>Mettre à jour un livre</h1>
                <div class="form-container">
                    <?php
                    include __DIR__ . '/db.php';

                    if (isset($_GET['id'])) {
                        $idLivre = intval($_GET['id']);
                        $conn = connectDB();
                        
                        // Récupérer les détails du livre
                        $stmt = $conn->prepare("SELECT * FROM livres WHERE id = ?");
                        $stmt->bindValue(1, $idLivre, PDO::PARAM_INT);
                        $stmt->execute();
                        $livre = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($livre) {
                            // Afficher le formulaire de mise à jour pré-rempli
                            echo "<form action='php/crud.php' method='POST'>
                                    <input type='hidden' name='id' value='" . $livre['id'] . "'>
                                    
                                    <div class='form-group'>
                                        <label for='titre'>Titre</label>
                                        <input type='text' id='titre' name='titre' value='" . htmlspecialchars($livre['titre']) . "' required>
                                    </div>

                                    <div class='form-group'>
                                        <label for='auteur'>Auteur</label>
                                        <input type='text' id='auteur' name='auteur' value='" . htmlspecialchars($livre['auteur']) . "' required>
                                    </div>

                                    <div class='form-group'>
                                        <label for='description'>Description</label>
                                        <textarea id='description' name='description' rows='4' required>" . htmlspecialchars($livre['description']) . "</textarea>
                                    </div>

                                    <div class='form-group'>
                                        <label for='maison_edition'>Maison d'édition</label>
                                        <input type='text' id='maison_edition' name='maison_edition' value='" . htmlspecialchars($livre['maison_edition']) . "' required>
                                    </div>

                                    <div class='form-group'>
                                        <label for='nombre_exemplaire'>Nombre d'exemplaires</label>
                                        <input type='number' id='nombre_exemplaire' name='nombre_exemplaire' value='" . htmlspecialchars($livre['nombre_exemplaire']) . "' required>
                                    </div>

                                    <div class='form-actions'>
                                        <button type='submit' class='btn btn-primary'>Mettre à jour</button>
                                        <a href='index.php#voir-tout' class='btn btn-secondary' style='margin-left: 10px; text-decoration: none; display: inline-block;'>Annuler</a>
                                    </div>
                                </form>";
                        } else {
                            echo "<p>Livre introuvable.</p>";
                            echo "<a href='index.php#voir-tout' class='btn btn-secondary'>Retour à la liste</a>";
                        }
                    } else {
                        echo "<p>Aucun ID de livre spécifié.</p>";
                        echo "<a href='index.php#voir-tout' class='btn btn-secondary'>Retour à la liste</a>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.container').classList.toggle('sidebar-collapsed');
        });
    </script>
</body>
</html>