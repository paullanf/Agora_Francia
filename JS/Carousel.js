$(document).ready(function() { 
    // Pour chaque carrousel sur la page
    $('.carrousel').each(function() {
        var $carrousel = $(this), // Cibler le carrousel actuel
            $img = $carrousel.find('img'), // Cibler les images du carrousel
            indexImg = $img.length - 1, // Définir l'index du dernier élément
            i = 0, // Initialiser le compteur
            $currentImg = $img.eq(i); // Cibler l'image courante, qui a l'index 0 au début

        $img.css('display', 'none'); // Cacher toutes les images
        $currentImg.css('display', 'block'); // Afficher seulement l'image courante

        // Fonction pour le défilement automatique des images
        function slideImg() {
            setTimeout(function() { // Fonction anonyme avec un délai
                if (i < indexImg) { // Si le compteur est inférieur au dernier index
                    i++; // Incrémenter le compteur
                } else { // Sinon, on revient à la première image
                    i = 0;  
                }
                $img.css('display', 'none'); // Cacher les images
                $currentImg = $img.eq(i); // Définir la nouvelle image
                $currentImg.css('display', 'block'); // Afficher la nouvelle image
                slideImg(); // Relancer la fonction pour un défilement continu
            }, 3000); // Intervalle de 3000 millisecondes (3s)
        }

        slideImg(); // Lancer la fonction une première fois pour démarrer le défilement automatique
    });
});
