<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
    <!-- Réutiliser la même navbar que index.php -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Bibliophile</label>
        <ul class="navbar">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php#liste">Nos livres</a></li>
            <li><a href="wishlist.html">Liste de lecture</a></li>
            <button class="register"><a href="register.html">S'inscrire</a></button>
        </ul>
    </nav>

    <section class="section-recherche">
        <h1>Résultats de recherche</h1>
        <form action="results.php" method="GET">
            <input type="text" name="query" 
                   value="<?php echo htmlspecialchars($_GET['query'] ?? ''); ?>" 
                   placeholder="Rechercher par titre ou auteur" required>
            <button type="submit"><i class="fas fa-search"></i> Rechercher</button>
        </form>
    </section>

    <section class="results">
        <div class="livres-container" id="resultats-container">
            <!-- Les résultats seront injectés ici -->
        </div>
    </section>

    <script>
        // Récupérer le terme de recherche depuis l'URL
        const urlParams = new URLSearchParams(window.location.search);
        const query = urlParams.get('query');

        // Fonction pour afficher les résultats
        function displayResults(results) {
            const container = document.getElementById('resultats-container');

            if (results.length === 0) {
                container.innerHTML = `
                    <div class="no-results">
                        <p>Aucun livre trouvé pour "${query}"</p>
                        <a href="index.php" class="btn-retour">Retourner à l'accueil</a>
                    </div>`;
                return;
            }

            container.innerHTML = results.map(book => `
                <div class="livre-card">
                    <h3>${book.titre}</h3>
                    <p>${book.auteur}</p>
                    <p class="description">${book.description.substring(0, 100)}...</p>
                    <a href="#" class="btn-details" 
                       onclick="afficherDetails(${book.id}); return false;">
                       Voir détails
                    </a>
                </div>
            `).join('');
        }

        // Récupérer les résultats depuis le serveur
        if (query) {
            fetch(`php/search.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => displayResults(data))
                .catch(error => {
                    console.error('Erreur:', error);
                    document.getElementById('resultats-container').innerHTML = 
                        '<p class="error">Une erreur est survenue lors de la recherche.</p>';
                });
        }
    </script>
</body>
</html>