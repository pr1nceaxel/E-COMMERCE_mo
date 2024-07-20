<?php 
    
    $users = [
        [ 					
            "numero"=> "010202030405",
            "nom"=> "hien",
            "prenom"=> "axel",
            "email"=> "axelvianney@gmail.com",
        ],
        [ 					
            "numero"=> "087456686406",
            "nom"=> "koffi",
            "prenom"=> "jean",
            "email"=> "koffijean@gmail.com",
        ],
        [ 					
            "numero"=> "010202030407",
            "nom"=> "kouame",
            "prenom"=> "alain",
            "email"=> "kouamealain@gmail.com",
        ],
        [ 					
            "numero"=> "544558547854",
            "nom"=> "kouassi",
            "prenom"=> "paul",
            "email"=> "kouassipaul@gmail.com",
        ],
        [ 					
            "numero"=> "566598598548",
            "nom"=> "goli",
            "prenom"=> "akilas",
            "email"=> "goliakilas@gmail.com",
        ],
    ];

    include("connexionbd.php");
    
    if($connexion->connect_error) {
        echo " erreur de connexion ".$connexion->connect_error; 
    } 
    else {
        echo "  connexion reussie"."<br>";
        foreach ($users as $user) {
            $numero = $user["numero"];
            $nom = $user["nom"];
            $prenom = $user["prenom"];
            $email = $user["email"];

            $requeteUser = "INSERT INTO user(numero, nom, prenom, email) VALUES ('$numero', '$nom', '$prenom', '$email')";
            $etat_enregistrement_user = $connexion->query($requeteUser);

            if ($etat_enregistrement_user == true) {
                echo " enregistrement utilisateur réussi" . "<br>";
            } else {
                echo " erreur utilisateur " . $connexion->error . "<br>";
            }
        }
}
    echo "enregistrement terminé"."<br>";
?>