// fetch("recuperation.php").then(response => response.json()).then(data => {
//     console.log(data);

fetch("recuperation.php")
    .then(response => response.json())
    .then(data => {
        const articlesContainer = document.getElementById("articles-container");
        let cartCount = 0; // Variable pour stocker le nombre d'articles dans le panier

        // Efface le contenu actuel du conteneur
        articlesContainer.innerHTML = '';

        // Fonction pour mettre à jour le nombre dans le panier et afficher un message
        function updateCartCount() {
            const spanElement = document.getElementById("cart-count");
            spanElement.innerText = cartCount.toString();
        }

        // Ajoute dynamiquement chaque article
        data.forEach(article => {
            const articleDiv = document.createElement("div");
            articleDiv.className = "h-80 w-70 bg-white rounded-xl shadow-md overflow-hidden";

            // Ajoute les détails de l'article
            articleDiv.innerHTML = `
                <img class="h-40 w-full object-contain" src="${article.photo_url}" alt="">
                <div class="p-1 font-bold text-2xl text-center uppercase">${article.nom}</div>
                <div class="text-gray-700 text-center font-bold uppercase">${article.prix} FCFA</div>
                <div class="flex justify-evenly mt-3">
                    <a href="details.php?id-article=${article.id}" class="bg-red-500 active:bg-red-700 font-bold text-white rounded-full px-7 text-lg flex">Voir+</a>
                    <a href="ajout_panier.php?id-article=${article.id}"class="bg-green-500 active:bg-green-700 font-bold text-white rounded-full px-7 text-lg flex" onclick="addToCart(${article.id})">Ajouter au panier</a>
                </div>
            `;

            // Ajoute l'article au conteneur
            articlesContainer.appendChild(articleDiv);
        });
    });

