<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
    <script src="data.js"></script>

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

    <header class="w-90 bg-white p-5 grid grid-cols-3 gap-4 mt-24" >
        <button class="text-white font-bold px-4 py-2 rounded bg-red-500 active:bg-red-700">MON COMPTE</button>
        <button class="text-white font-bold px-4 py-2 rounded bg-red-500 active:bg-red-700">PASSER UNE COMMANDE</button>
        <button class="text-white font-bold px-4 py-2 rounded bg-red-500 active:bg-red-700">CATALOGUE</button>
    </header>

    <div  class="w-screen flex justify-evenly p-10">

        <div id="articles-container" class="w-4/5 grid grid-cols-3 gap-4 bg-white-500 p-2">
           
       
        </div>
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

</body>
</html>