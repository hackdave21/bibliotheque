// Fonction pour ajouter un livre à la liste de lecture
function addToWishlist() {
    const idLivre = new URLSearchParams(window.location.search).get('id');
    const idLecteur = 1; 

    if (idLivre && idLecteur) {
        fetch('php/wishlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_livre=${idLivre}&id_lecteur=${idLecteur}`,
        })
            .then((response) => response.text())
            .then((result) => {
                alert('Le livre a été ajouté à votre liste de lecture.');
            })
            .catch((error) => console.error('Erreur:', error));
    } else {
        alert('Impossible d\'ajouter le livre à votre liste de lecture.');
    }
}

// Charger les résultats de recherche dynamiquement
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('query');

    if (query) {
        fetch(`php/search.php?query=${query}`)
            .then((response) => response.text())
            .then((data) => {
                document.getElementById('results').innerHTML = data;
            })
            .catch((error) => console.error('Erreur:', error));
    }

    // Charger les détails du livre dynamiquement
    const bookId = urlParams.get('id');
    if (bookId) {
        fetch(`php/details.php?id=${bookId}`)
            .then((response) => response.text())
            .then((data) => {
                document.getElementById('book-details').innerHTML = data;
            })
            .catch((error) => console.error('Erreur:', error));
    }

    // Charger la liste de lecture dynamiquement
    const lecteurId = 1; // Remplacez par l'ID réel du lecteur connecté
    fetch(`php/wishlist.php?id_lecteur=${lecteurId}`)
        .then((response) => response.text())
        .then((data) => {
            document.getElementById('wishlist').innerHTML = data;
        })
        .catch((error) => console.error('Erreur:', error));
});