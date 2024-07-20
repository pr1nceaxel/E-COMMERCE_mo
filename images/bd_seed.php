<?php 

    $articles = [ 
  
        [
            "photo_url" => "https://www.negoce.ci/11257-home_default/camon-19-pro-mondrian-8gb-ram-256gb.jpg",
            "prix"=> "90000",
            "nom"=> "tecno",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://images.frandroid.com/wp-content/uploads/2023/02/samsung-galaxy-s23-ultra-photo-test-4-scaled.jpg",
            "prix"=> "90000",
            "nom"=> "galaxy",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://fr.shopping.rakuten.com/photo/2232692796_ML_NOPAD.jpg",
            "prix"=> "90000",
            "nom"=> "rakuten",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://www.rueducommerce.fr/medias/143832da2c903212bf595070f96bff51/p_640x640/charte-visuel-rdc-1500-1500.jpg",
            "prix"=> "90000",
            "nom"=> "google",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://cdn.idealo.com/folder/Product/200503/4/200503488/s4_produktbild_mittelgross/google-pixel-4a.jpg",
            "prix"=> "90000",
            "nom"=> "google 2",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://tunisiatech.tn/8882-large_default/smartphone-oppo-a17-4go-64go.jpg",
            "prix"=> "90000",
            "nom"=> "pocco",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://consumer.huawei.com/content/dam/huawei-cbg-site/common/mkt/plp/phones-20230509/view-all-phones/all-nova11-pro.png",
            "prix"=> "90000",
            "nom"=> "huawei",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://th.bing.com/th/id/OIP.VKB1I_Nw_oHlIm90nTQCtgHaEK?rs=1&pid=ImgDetMain",
            "prix"=> "100000",
            "nom"=> "iphonex",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://images.samsung.com/is/image/samsung/africa-fr-galaxy-a71-a715-sm-a715fzkuxfe-front-208777433?$650_519_PNG$",
            "prix"=> "80000",
            "nom"=> "Samsung",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],
        [
            "photo_url" => "https://images.frandroid.com/wp-content/uploads/2017/02/samsung-galaxy-s8-par-benjamin-geskin-1.png",
            "prix"=> "90000",
            "nom"=> "Samsung 8s",
            "description"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur molestiae rem omnis vitae voluptatibus aliquid voluptatem dolor delectus ducimus quam!",
        ],

    ];

    include("connexionbd.php");

    if($connexion->connect_error) {
        echo " erreur de connexion ".$connexion->connect_error; 
    } 
    else {
        echo "  connexion reussie"."<br>";
        foreach($articles as $article) {

            $photo_url = $article ["photo_url"];
            $prix = $article ["prix"];
            $nom = $article ["nom"];
            $description = $article ["description"];

            $requete = "INSERT INTO article(photo_url, prix, nom, description) VALUES ('$photo_url', '$prix', '$nom', '$description')";
            $etat_enregistrement = $connexion->query($requete);

            if($etat_enregistrement == true) {
                echo "enregistrement reussie"."<br>";
            }else {
                echo "erreur ".$connexion->error."<br>";
            }
        }
}
    echo "enregistrement terminé"."<br>";
?>