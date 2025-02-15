<?php
// Inclure le fichier db.php pour accéder à la fonction getLivres()
require_once 'php/db.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" 
          content="width=device-width,
                   initial-scale=1.0">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Bibliothèque en ligne</label>
        <ul class="navbar">
            <li><a class="active" href="index.html">Accueil</a></li>
            <li><a href="#">Nos livres</a></li>
            <li><a href="wishlist.html">Favoris</a></li>
            <li><a href="contact.html">Contact</a></li>
            <button class="register"><a href="register.html">S'inscrire</a></button>
        </ul>
    </nav>

    <section class="section-bienvenue">
        <div class="bienvenue-content">
            <h1>Bienvenue dans notre bibliothèque en ligne</h1>
            <p>Cette bibliothèque est entièrement à vous. Vous avez la possibilité d'ajouter, de modifier ou même de supprimer les livres de la collection des livres.</p>
            <a href="#" class="btn-decouvrir">Découvrir plus <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="bienvenue-image">
            <img src="images/fille.png" alt="Bibliothèque" height="300px">
        </div>
    </section>

    <section class="section-recherche">
        <h2>Faites votre recherche</h2>
        <p>Vous avez un livre que vous aimeriez lire ? Tapez juste son titre ou le nom de l'auteur.</p>
        <form action="results.html" method="GET">
            <input type="text" name="query" placeholder="Rechercher par titre ou auteur" required>
            <button type="submit"><i class="fas fa-search"></i> Rechercher</button>
        </form>
    </section>

    <section class="section-populaire">
        <h2>Livres déjà diponibles</h2>
        <div class="livres-container">
            <div class="livres-container">
                <?php 
                $livres = getLivres();
                foreach($livres as $livre) : 
                ?>
                    <div class="livre-card">
                        <h3><?php echo htmlspecialchars($livre['titre']); ?></h3>
                        <p><?php echo htmlspecialchars($livre['auteur']); ?></p>
                        <a href="details.php?id=<?php echo $livre['id']; ?>" class="btn-details">Voir détails</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section-services">
        <h2>Nos services</h2>
        <div class="services-container">
            <div class="service-card">
                <i class="fas fa-book-open"></i>
                <h3>Large collection</h3>
                <p>Accédez à des livres soit déjà disponible ou ajouté par vous même ou par d'autres utilisateurs de la bibliothèque</p>
            </div>
            <div class="service-card">
                <i class="fas fa-user-plus"></i>
                <h3>Simple pour nos utilisateurs</h3>
                <p>Vous n'avez pas besoin de vous inscrire pour pour avoir accès à notre collection</p>
            </div>
            <div class="service-card">
                <i class="fas fa-headset"></i>
                <h3>Disponibilité 24/7</h3>
                <p>Notre équipe est disponible pour vous aider à tout moment</p>
            </div>
        </div>                     
    </section>

</body>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-section about">
            <h3>À propos de nous</h3>
            <p>La bibliothèque en ligne est un projet dédié à la promotion de la lecture et à la gestion des livres numériques. Nous offrons une plateforme conviviale pour découvrir, ajouter et gérer vos livres préférés.</p>
        </div>
        <div class="footer-section links">
            <h3>Liens rapides</h3>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="#">Nos livres</a></li>
                <li><a href="wishlist.html">Favoris</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <h3>Contactez-nous</h3>
            <p><i class="fas fa-map-marker-alt"></i> Agoè-Logope, Lomé, Togo</p>
            <p><i class="fas fa-phone"></i> +228 93 61 71 32</p>
            <p><i class="fas fa-envelope"></i> flutterdave8@gmail.com</p>
        </div>
        <div class="footer-section social">
            <h3>Suivez-nous</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2025 Bibliothèque en ligne | Powered by flutter_dave
    </div>
</footer>

</html>

