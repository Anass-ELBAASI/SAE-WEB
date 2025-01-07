
const image = document.getElementById('scroll-image');

// Ajoutez un gestionnaire d'événements pour détecter le défilement
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) { // Si on défile plus de 50px
        image.classList.add('hidden'); // Ajoute la classe "hidden"
    } else {
        image.classList.remove('hidden'); // Enlève la classe "hidden"
    }
});