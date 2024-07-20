<?php
session_start();
include("connexionbd.php");

   //supprimer les produits
   //si la variable del existe
   if(isset($_GET['del'])){
    $id_del = $_GET['del'];

    // Vérifier si l'article est présent dans le panier
    if(isset($_SESSION['panier'][$id_del])) {
        // Décrémenter la quantité de 1
        $_SESSION['panier'][$id_del]--;

        // Si la quantité atteint zéro, supprimer complètement l'article du panier
        if($_SESSION['panier'][$id_del] <= 0) {
            unset($_SESSION['panier'][$id_del]);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="styles_panier.css"> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
</head>

<body>

    <nav  id="index">
        <div class="fixed top-0 left-0 w-full p-4 bg-blue-500 flex justify-around ">
            <img src="images/Logo.jpg" class="w-20 h-20">
            <ul class="flex grid grid-cols-4 gap-4"  >
                <li><a href="index.php">Accueil</a></li>
                <li><a href="#">A Propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a class="scroll-link" href="#footer">Contacts</a></li>
            </ul>
        </div>

    </nav>

    <main class="flex  justify-around  mt-20" >
        <section class=" flex-1 bg-yellow-500   border shadow-lg rounded-lg mt-20 ml-5 mb-20 p-20" >

            <table class="border-collapse w-full text-xs ">
                <tr>
                    <th ></th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Action</th>
                </tr>
                <?php
                   $total = 0;
                   
                   $ids = array_keys($_SESSION['panier']);
                   
                   if (empty($ids)) {
                       echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
                   } else {
                       $query = "SELECT * FROM article WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")";
                       $products = mysqli_query($connexion, $query);
                   
                       if (!$products) {
                           die("Erreur dans la requête : " . mysqli_error($connexion));
                       }
                   
                        foreach ($products as $article) :
                           $total += $article['prix'] * $_SESSION['panier'][$article['id']];

                           // Convertir les données binaires en base64 pour l'affichage dans une balise img
                            $imageData = base64_encode($article['img']);

                           echo "<tr class='text-center'>
                                    <td><img src='data:image/jpeg;base64,{$imageData}' width='100'></td>
                                    <td>{$article['nom']}</td>
                                    <td class='text-center'>{$article['prix']}  Fcfa</td>
                                    <td>{$_SESSION['panier'][$article['id']]}</td>
                                    <td class='flex items-center justify-center'>
                                       <div class='text-center'>
                                           <a href='mon_panier.php?del={$article['id']}'><img src='images/delete.png' width='40' alt='Supprimer'></a>
                                       </div>
                                   </td>
                               </tr>";
                        endforeach;
                   }
                 ?>

                <td>
                        <a href='index.php'class='bg-red-500 inline-flex text-center active:bg-green-700 font-bold text-white rounded-full px-7 py-5 text-lg mt-5 '>RETOUR</a>
                </td>

            </table>

        </section>

        <section class=" flex-3 mb-20 mt-20 px-20" >
            <div class="border p-9 shadow-lg rounded-lg mb-4 ml-20">
                <div class="mb-4">
                    <article>
                        <h1 class="text-2xl font-bold mb-2">RÉSUMÉ DU PANIER</h1>
                        <div class="mb-2">
                            <p class="text-gray-600">Total :</p>
                            <p class="text-lg font-semibold"> <?=$total?>   FCFA</p>
                        </div>
                        <div>
                        <a href="commande.php" id="commanderBtn" class="bg-blue-500 text-white py-2 px-4 rounded block text-center font-semibold uppercase">Commander</a>
                            <!-- <a href='commande.php?id-article=$id_article&nom-article=$nom' class='bg-red-500 inline-flex text-center active:bg-red-700 font-bold text-white rounded-full px-7 text-lg flex mx-auto mt-3'>Commander cet article</a> -->
                        </div>

                            <!-- pour  afficher lepop-up   quand   le  panie   est vide -->


                                <script>
                                    document.getElementById('commanderBtn').addEventListener('click', function(event) {
                                        // Vérifier si le panier est vide
                                        if (<?= empty($ids) ? 'true' : 'false' ?>) {
                                            // Empêcher la redirection par défaut
                                            event.preventDefault();
                                            
                                            // Afficher la popup indiquant que le panier est vide
                                            alert('Votre panier est vide. Ajoutez des articles avant de commander.');
                                        }
                                    });
                                </script>
                    </article>
                </div>
            </div>
        </section>
        
    </main>


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