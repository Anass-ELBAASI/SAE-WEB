document.addEventListener('DOMContentLoaded', () => {
    // Sélectionne le conteneur où la navbar sera chargée
    const navbarContainer = document.getElementById('navbar-container');

    fetch('../public/navbar.php')
        .then(response => response.text())
        .then(data => {
            navbarContainer.innerHTML = data;
        })
        .catch(error => console.error('Erreur lors du chargement de la navbar:', error));
});