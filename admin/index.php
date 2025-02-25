<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Bibliophile</title>
    <link rel="stylesheet" href="css/styl.css">
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
                <li class="menu-item active" data-section="dashboard">
                    <a href="#dashboard">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item" data-section="ajouter">
                    <a href="#ajouter">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter</span>
                    </a>
                </li>
                <li class="menu-item" data-section="voir-tout">
                    <a href="#voir-tout">
                        <i class="fas fa-list"></i>
                        <span>Voir tout</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-section active" id="dashboard-section">
                <h1>Dashboard</h1>
                <div class="dashboard-stats">
                    <p>Bienvenue dans le panneau d'administration de la bibliothèque.</p>
                    <p>Utilisez le menu latéral pour naviguer entre les différentes sections.</p>
                </div>
            </div>
            
            <div class="content-section" id="ajouter-section">
                <h1>Ajouter un livre</h1>
                <div class="form-container">
                    <form action="php/crud.php" method="POST">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" id="titre" name="titre" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="auteur">Auteur</label>
                            <input type="text" id="auteur" name="auteur" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="maison_edition">Maison d'édition</label>
                            <input type="text" id="maison_edition" name="maison_edition" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre_exemplaire">Nombre d'exemplaires</label>
                            <input type="number" id="nombre_exemplaire" name="nombre_exemplaire" min="1" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Ajouter le livre</button>
                    </form>
                </div>
            </div>
            
            <div class="content-section" id="voir-tout-section">
                <h1>Liste des livres</h1>
                <div class="books-list" id="books-container">
                    <!-- Les livres seront chargés ici par JavaScript -->
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.container').classList.toggle('sidebar-collapsed');
        });

        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.remove('active');
                });
                
                this.classList.add('active');
                const sectionId = this.getAttribute('data-section') + '-section';
                document.getElementById(sectionId).classList.add('active');
                if (sectionId === 'voir-tout-section') {
                    loadBooks();
                }
            });
        });

        // Fonction pour charger les livres
        function loadBooks() {
            fetch('php/get_books.php')
                .then(response => response.json())
                .then(books => {
                    const booksContainer = document.getElementById('books-container');
                    booksContainer.innerHTML = '';
                    
                    if (books.length === 0) {
                        booksContainer.innerHTML = '<p>Aucun livre disponible pour le moment.</p>';
                        return;
                    }
                    
                    books.forEach(book => {
                        const bookItem = document.createElement('div');
                        bookItem.className = 'book-item';
                        bookItem.innerHTML = `
                            <div class="book-info">
                                <h3>${book.titre}</h3>
                                <p><strong>Auteur:</strong> ${book.auteur}</p>
                            </div>
                            <div class="book-actions">
                                <button class="btn btn-warning" onclick="updateBook(${book.id})">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                                <button class="btn btn-danger" onclick="deleteBook(${book.id}, '${book.titre}')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </div>
                        `;
                        booksContainer.appendChild(bookItem);
                    });
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des livres:', error);
                    document.getElementById('books-container').innerHTML = 
                        '<p>Une erreur est survenue lors du chargement des livres.</p>';
                });
        }

        // Fonction pour supprimer un livre
        function deleteBook(id, titre) {
            if (confirm(`Êtes-vous sûr de vouloir supprimer "${titre}" ?`)) {
                fetch(`php/crud.php?id=${id}`, { method: 'GET' })
                    .then(response => {
                        alert('Le livre a été supprimé avec succès.');
                        loadBooks(); // Recharger la liste
                    })
                    .catch(error => {
                        console.error('Erreur lors de la suppression:', error);
                        alert('Une erreur est survenue lors de la suppression du livre.');
                    });
            }
        }

        // Fonction pour rediriger vers la page de mise à jour
        function updateBook(id) {
            window.location.href = `php/update.php?id=${id}`;
        }
    </script>
</body>
</html>