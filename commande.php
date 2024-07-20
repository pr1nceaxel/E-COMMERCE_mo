<?php
    session_start();

    include("connexionbd.php");

    // Récupération des articles
    $requeteArticles = "SELECT id, photo_url, prix, nom, description FROM article";
    $resultatsArticles = $connexion->query($requeteArticles);

    // Récupération des utilisateurs
    $requeteUsers = "SELECT id, numero, nom, prenom, email FROM user";
    $resultatsUsers = $connexion->query($requeteUsers); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
</head>

<body>
    <nav class="container" id="index">
        <div class="Navbar">
            <img src="images/Logo.jpg" class="logo">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">A Propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a class="scroll-link" href="#footer">Contacts</a></li>
            </ul>
        </div>
    </nav>
    
    <form action="enregistrement.php" method="POST">
        <div class="min-h-screen mt-32 px-72">
            <div class="text-3xl font-bold text-green-400 my-4">
                <span>Entrez vos informations pour la commande</span>
            </div>
            <input class="rounded-md my-2 border p-2" type="text" placeholder="Entrez votre Nom" name="nom" required><br>
            <input class="rounded-md my-2 border p-2" type="text" placeholder="Entrez votre Prenom" name="prenom" required><br>
            <input class="rounded-md my-2 border p-2" type="tel" placeholder="Entrez votre Numero" name="numero" required pattern="[0-9]{10}"><br>
            <input class="rounded-md my-2 border p-2" type="email" placeholder="Entrez votre Email" name="email" required><br>
            <button type="submit" class="bg-green-500 inline-flex active:bg-green-700 font-bold text-white rounded-full px-7 text-lg flex mx-auto mt-3">VALIDER MA COMMANDE</button>
            <a ref="mon_panier.php" class="bg-red-500 inline-flex active:bg-red-700 font-bold text-white rounded-full px-7 text-lg flex mx-auto mt-3">RETOUR</a>

            <?php

                // Récupéreration les clés du tableau de panier (qui sont les ID des articles)
                $articleIds = array_keys($_SESSION['panier']);

                // Ajout d'un champ caché au formulaire avec tous les ID des articles
                foreach ($articleIds as $id_article) {
                    echo "<input type='hidden' name='panier[]' value='{$id_article}'>";
                }

            ?>


            
        </div>
    </form>

    <footer id="footer" class="mt-10">
        <div class="footer-section">
            <h2>À propos de nous</h2>
            <p>DASI SITE E-COMMERCE</p>
        </div>

        <div class="footer-section">
            <h2>Liens utiles</h2>
            <ul>
                <li><a class="scroll-link" href="#index">Accueil</a></li>
                <li><a href="#">A Propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contacts</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h2>Assistance</h2>
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Politique de retour</a></li>
                <li><a href="#">Service client</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h2>Restez connecté</h2>
            <p>Suivez-nous sur les réseaux sociaux.</p>
            <div class="social-icons">
                <a href="#"><img src="images/facebook.jpg" alt="Facebook"></a>
                <a href="#"><img src="images/instagram.jpg" alt="Instagram"></a>
                <a href="#"><img src="images/twitter.jpg" alt="Twitter"></a>
            </div>
        </div>
    </footer>
    <script src="data.js"></script>
    <script src="panier.js"></script>


</body>
</html>