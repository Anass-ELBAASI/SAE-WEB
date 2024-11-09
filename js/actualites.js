// Applique l'animation de slideInFromRight aux éléments avec la classe 'box' et 'titre-actualites'
document.addEventListener("DOMContentLoaded", () => {
    // Animation pour les éléments "box"
    document.querySelectorAll(".box").forEach((box, index) => {
        box.style.opacity = "0";
        box.style.transition = "transform 0.3s ease, box-shadow 0.3s ease";
        box.style.transform = "translateX(100%)";

        // Délai d'animation pour un effet progressif
        setTimeout(() => {
            box.style.transform = "translateX(0)";
            box.style.opacity = "1";
        }, 100 * index); // Délai en fonction de l'index pour un effet progressif
    });

    // Animation pour le titre
    const titre = document.querySelector("h1.titre-actualites");
    if (titre) {
        titre.style.transform = "translateX(100%)";
        titre.style.opacity = "0";

        setTimeout(() => {
            titre.style.transform = "translateX(0)";
            titre.style.opacity = "1";
            titre.style.transition = "transform 1s ease-out, opacity 1s ease-out";
        }, 500); // Délai pour synchroniser avec l'apparition des boîtes
    }
});

// Effet de survol pour les éléments "box"
document.querySelectorAll(".box").forEach(box => {
    box.addEventListener("mouseenter", () => {
        box.style.transform = "translateY(-5px)";
        box.style.boxShadow = "0 8px 16px rgba(0, 0, 0, 0.2)";
    });

    box.addEventListener("mouseleave", () => {
        box.style.transform = "translateY(0)";
        box.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
    });
});

// Effet de survol et d'interaction pour les boutons
document.querySelectorAll(".filters button").forEach(button => {
    button.addEventListener("mouseenter", () => {
        button.style.backgroundColor = "#5a92ab";
        button.style.boxShadow = "0 6px 12px rgba(0, 0, 0, 0.2)";
    });

    button.addEventListener("mouseleave", () => {
        button.style.backgroundColor = "#6da3bd";
        button.style.boxShadow = "0 4px 6px rgba(0, 0, 0, 0.1)";
    });

    button.addEventListener("mousedown", () => {
        button.style.backgroundColor = "#4e8099";
        button.style.transform = "scale(0.98)";
    });

    button.addEventListener("mouseup", () => {
        button.style.backgroundColor = "#5a92ab";
        button.style.transform = "scale(1)";
    });
});

// Fonction pour afficher le popup
function showPopup(event) {
    // Affiche le popup
    const popup = document.getElementById("popup-bulle");
    popup.style.display = "flex"; // Utilise flex pour centrer le contenu

    // Empêche la propagation du clic vers d'autres éléments
    event.stopPropagation();
}

// Fonction pour fermer le popup
function closePopup() {
    document.getElementById("popup-bulle").style.display = "none";
}

// Fermer le popup si on clique en dehors du contenu
document.addEventListener("click", function(event) {
    const popup = document.getElementById("popup-bulle");
    const content = document.querySelector(".popup-content");
    if (popup.style.display === "flex" && !content.contains(event.target)) {
        closePopup();
    }
});
