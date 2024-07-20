<?php
// inclure la page de connexion
include_once "connexionbd.php";
// verifier si la session existe
if (!isset($_SESSION)){
    // sinon demarrer la session
    session_start();
}
// creer la session
if (!isset($_SESSION['panier'])){

    // s'il n'existe pas une session on crée une et On mets un tableau à l'interieur
$_SESSION['panier'] = array();
}

// recuperation de l'id dans le lien
if (isset($_GET['id-article'])){ //si un id à été envoyé alors;

$id = $_GET['id-article'] ;
// verifier grace à l'id si le produit existe dans la base de données
$produit2 = mysqli_query($connexion ,"SELECT* FROM article where id=$id");

if (empty(mysqli_fetch_assoc($produit2))){
    // si ce produit n'existe pas
    die("ce produit n'existe pas");
}
// ajouter le produit dans le panier (le tableau)

if(isset($_SESSION['panier'][$id])){  //si le produit est deja dans le panier
    $_SESSION['panier'][$id]++; //represente la quantité
} else {
    //sinon on ajoute le produit
    $_SESSION['panier'][$id]= 1;
    echo "Le produit a  bien été mis dans le panier !";
    //afficher le tableau associé au panier
}
}
header("Location: details.php?id-article=$id");

?>