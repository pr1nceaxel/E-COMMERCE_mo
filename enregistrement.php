<?php
session_start();

unset($_SESSION['panier']);

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

    <div class=" m-45 p-60">
    <?php
include("connexionbd.php");

function generateOrderReference() {
    // Obtenez la date et l'heure actuelles
    $currentDatetime = new DateTime();

    // Générez une partie de la référence basée sur la date et l'heure
    $datePart = $currentDatetime->format("YmdHis");

    // Générez une partie aléatoire de la référence
    $randomPart = strtoupper(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz0123456789", 4)), 0, 4));

    // Assemblez la référence complète
    $orderReference = "CMD-" . $datePart . "-" . $randomPart;

    return $orderReference;
}


function insertUser($connexion, $nom, $prenom, $numero, $email) {
    $requete = $connexion->prepare("INSERT INTO user(nom, prenom, numero, email) VALUES (?, ?, ?, ?)");
    $requete->bind_param("ssss", $nom, $prenom, $numero, $email);
    return $requete->execute();
}

function insertOrder($connexion, $user_id, $article_id) {
    $ref = generateOrderReference();
    $etat = 'Très bon etat';
    
    $requete_commande = $connexion->prepare("INSERT INTO commande(user_id, article_id, ref, etat) VALUES (?, ?, ?, ?)");
    $requete_commande->bind_param("iiss", $user_id, $article_id, $ref, $etat);
    return $requete_commande->execute();
}

if ($connexion->connect_error) {
    die("Erreur de connexion " . $connexion->connect_error);
} else {
    echo "Connexion base de donnée réussie" . "<br>";

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    // Articles du panier
    $panier = $_POST['panier'];

    // Obtenez les clés (id_article) du panier
    $ids_articles = array_keys($panier);

    // Générez la référence unique pour la commande
    $orderReference = generateOrderReference();

    if (insertUser($connexion, $nom, $prenom, $numero, $email)) {
        echo "Enregistrement du client réussi" . "<br>";
        $user_id = $connexion->insert_id;

        // Itérez sur les articles du panier
        foreach ($ids_articles as $id_article) {
            // Appel de la fonction pour insérer chaque article dans la commande
            if (insertOrder($connexion, $user_id, $id_article)) {
                echo "Enregistrement de la commande pour l'article $id_article réussi" . "<br>";
            } else {
                echo "Erreur lors de l'enregistrement de la commande pour l'article $id_article : " . $connexion->error . "<br>";
            }
        }
        } else {
            echo "Erreur lors de l'enregistrement du client" . $connexion->error . "<br>";
        }
    }
    echo "Enregistrement terminé" . "<br>";

    echo  '    <a href="index.php" class="bg-red-500 inline-flex active:bg-red-700 font-bold text-white rounded-full px-7 text-lg flex mx-auto mt-3">RETOUR</a>';


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
                <li><a class="uppercase text-white-500" href="index.php">Accueil</a></li>
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