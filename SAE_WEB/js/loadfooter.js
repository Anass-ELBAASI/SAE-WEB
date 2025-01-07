document.addEventListener('DOMContentLoaded', () => {
    const footerContainer = document.getElementById('footer-container');

    // Charge le fichier footer.html
    fetch('loadfooter.html')
        .then(response => response.text())
        .then(data => {
            footerContainer.innerHTML = data;
        })
        .catch(error => console.error('Erreur lors du chargement du footer:', error));
});