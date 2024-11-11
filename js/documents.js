function searchDocuments() {
    // Récupère la valeur du champ de recherche
    let input = document.getElementById('myInput');
    let filter = input.value.toUpperCase(); // Convertir en majuscule pour une recherche insensible à la casse
    let documentsContainer = document.getElementById('documentsContainer'); // Conteneur des documents
    let sections = documentsContainer.getElementsByClassName('section'); // Sections contenant les documents

    // Parcours chaque section
    for (let i = 0; i < sections.length; i++) {
        let section = sections[i];
        let links = section.getElementsByClassName('doc-card'); // Tous les liens (documents) dans la section

        // Parcours chaque lien
        for (let j = 0; j < links.length; j++) {
            let link = links[j];
            let text = link.textContent || link.innerText; // Récupère le texte du lien

            // Vérifie si le texte du lien contient la valeur de la recherche
            if (text.toUpperCase().indexOf(filter) > -1) {
                link.style.display = ""; // Affiche le lien
            } else {
                link.style.display = "none"; // Cache le lien
            }
        }
    }
}