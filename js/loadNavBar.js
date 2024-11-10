document.addEventListener('DOMContentLoaded', () => {
    // Sélectionne le conteneur où la navbar sera chargée
    const navbarContainer = document.getElementById('navbar-container');

    // Charge le fichier navbar.html
    fetch('navbar.html')
        .then(response => response.text())
        .then(data => {
            // Insère le contenu dans le conteneur
            navbarContainer.innerHTML = data;
        })
        .catch(error => console.error('Erreur lors du chargement de la navbar:', error));
});