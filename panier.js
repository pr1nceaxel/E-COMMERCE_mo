// SCRIPT POUR UN SCROLL FLUIDE
document.addEventListener("DOMContentLoaded", function () {
    var scrollLinks = document.querySelectorAll('.scroll-link');

    scrollLinks.forEach(function (scrollLink) {
        scrollLink.addEventListener('click', function (e) {
            e.preventDefault();

            var targetId = this.getAttribute('href').substring(1);
            var targetElement = document.getElementById(targetId);

            window.scrollTo({
                top: targetElement.offsetTop,
                behavior: 'smooth'
            });
        });
    });
});

// SCRIPT POUR ENVOYER LES ELEMENTS ELECTIONNER AU PANIER
let bouton1 = document.getElementById("bouton");
let panier = document.getElementById("panier")

bouton1.addEventListener("click",function(){
    let prix = bouton1.previousElementSibling;
    let nom = bouton1.previousElementSibling.previousElementSibling;
    console.log(panier.innerHTML);
    let occurence = "<div class='items-center justify-between mb-2'><div class='truncate'>"+nom.innerText+"</div><div class='text-gray-700'>"+prix.innerText+"</div><button class='bg-red-500 active:bg-red-700  px-2 rounded-full ml-2 text-white'>Supprimer</button></div>";
    
    
    panier.innerHTML += occurence;
})


