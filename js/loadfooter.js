document.addEventListener('DOMContentLoaded', () => {
    // Sélectionne le conteneur où le footer sera chargé
    const footerContainer = document.getElementById('footer-container');

    // Charge le fichier footer.html
    fetch('loadfooter.html')
        .then(response => response.text())
        .then(data => {
            // Insère le contenu dans le conteneur
            footerContainer.innerHTML = data;
        })
        .catch(error => console.error('Erreur lors du chargement du footer:', error));
});