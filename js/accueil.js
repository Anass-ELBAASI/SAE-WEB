document.addEventListener("DOMContentLoaded", function() {
    const logoItems = document.querySelectorAll('.logo-item');

    logoItems.forEach((item) => {
        // Création du SVG
        const svgNS = "http://www.w3.org/2000/svg";
        const svg = document.createElementNS(svgNS, "svg");
        svg.setAttribute("width", "150");
        svg.setAttribute("height", "150");
        svg.setAttribute("viewBox", "0 0 150 150");
        svg.style.position = "absolute";
        svg.style.top = "0";
        svg.style.left = "0";
        svg.style.zIndex = "0"; // SVG en arrière-plan

        // Création du rectangle avec coins arrondis
        const rect = document.createElementNS(svgNS, "rect");
        rect.setAttribute("width", "150");
        rect.setAttribute("height", "150");
        rect.setAttribute("rx", "30"); // Rayon pour les coins arrondis
        rect.setAttribute("ry", "30");
        rect.setAttribute("fill", "#f1f1f1"); // Couleur de fond du carré SVG (modifiable)
        rect.setAttribute("stroke", "#756B8C");
        rect.setAttribute("stroke-width", "5");

        // Ajouter le rectangle au SVG, puis le SVG à l'élément logo-item
        svg.appendChild(rect);
        item.prepend(svg);
    });
});