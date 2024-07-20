<?php

session_start();

include("connexionbd.php");

// Récupération des articles
$requeteArticles = "SELECT id, photo_url, prix, nom, description FROM article";
$resultatsArticles = $connexion->query($requeteArticles);

// Récupération des utilisateurs
$requeteUsers = "SELECT id, numero, nom, prenom, email FROM user";
$resultatsUsers = $connexion->query($requeteUsers); ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
</head>

<body>
    <div class="container" id="index">
        <div class="Navbar">
            <img src="images/Logo.jpg" class="logo">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">A Propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#footer">Contacts</a></li>
                <li><a href="mon_panier.php"  ><img src="https://lefromagefr.files.wordpress.com/2013/08/logo-panier-vert.jpg" width="50" alt="Twitter" class="absolute top-5 right-12">
                    <span class="bg-black text-white rounded-full h-6 w-6 flex items-center justify-center absolute top-0 right-6 mt-2 mr-2" id="cart-count"> <?= array_sum($_SESSION['panier'])?> </span>
                </a></li>

            </ul>
            
        </div>
    </div>


    <div class="min-h-screen mt-32 px-72">
        <?php 

            include("connexionbd.php");

            if($connexion->connect_error) {
                echo " erreur de connexion ".$connexion->connect_error; 
            } 
            else {

                // echo "  connexion reussie"."<br>";

                $id_article = $_GET['id-article'];

                $requete = "SELECT * FROM article WHERE id=$id_article";

                $resultats = $connexion->query($requete);
                
                $article = $resultats->fetch_assoc();

                // var_dump($article['id']);
                $id_article = $article["id"];
                $photo_url = $article['photo_url'];
                $prix = $article['prix'];
                $nom =  $article['nom'];
                $description = $article['description'];

                echo "
                    <div class='flex justify-center'>
                        <img src='$photo_url' alt=''>
                    </div>

                    <div class='font-bold text-green-400 italic mt-4 mb-2 text-4xl'>$prix FCFA</div>

                    <div class='font-bold text-3xl mb-4'>$nom</div>

                    <div>$description</div>

                    <a href='ajout2_panier.php?id-article=$id_article'class='bg-green-500 inline-flex text-center active:bg-green-700 font-bold text-white rounded-full px-7 py-5 text-lg flex mx-auto mt-3 mb-7 uppercase' onclick='addToCart($id_article)'>Ajouter au panier</a> 
                    <a href='index.php' class='bg-red-500 inline-flex text-center active:bg-green-700 font-bold text-white rounded-full px-7 py-5 text-lg flex mx-auto mt-3 mb-7 ml-5'>RETOUR</a>

                ";
                
                $connexion->close();
            }
        ?>
    </div>


    <footer id="footer" class=" bottom-0 left-0 w-full bg-gray-800 text-white p-4 flex justify-around">
        <div class="footer-section">
            <h2>À propos de nous</h2>
            <p>DASI SITE E-COMMERCE</p>
        </div>

        <div class="footer-section">
            <h2>Liens utiles</h2>
            <ul>
                <li><a class="uppercase text-white-500" href="#index">Accueil</a></li>
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
            <div class="flex w-40 h-40 px-4 py-4 grid-cols-3 gap-6">
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