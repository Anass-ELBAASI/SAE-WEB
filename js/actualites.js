// Applique l'animation d'apparition aux éléments 'box' et au titre 'titre-actualites'
document.addEventListener("DOMContentLoaded", () => {
    // Animation pour les éléments de classe 'box'
    const boxes = document.querySelectorAll(".box");
    boxes.forEach((box, index) => {
        box.style.opacity = "0";
        box.style.transition = "transform 0.3s ease, box-shadow 0.3s ease";
        box.style.transform = "translateX(100%)";

        // Délai progressif pour chaque 'box'
        setTimeout(() => {
            box.style.transform = "translateX(0)";
            box.style.opacity = "1";
        }, 100 * index);
    });

    // Animation pour le titre principal
    const titre = document.querySelector("h1.titre-actualites");
    if (titre) {
        titre.style.opacity = "0";
        titre.style.transform = "translateX(100%)";
        setTimeout(() => {
            titre.style.transform = "translateX(0)";
            titre.style.opacity = "1";
            titre.style.transition = "transform 1s ease-out, opacity 1s ease-out";
        }, 500);
    }
});

// Effet de survol pour les éléments 'box'
document.addEventListener("mouseover", (event) => {
    const box = event.target.closest(".box");
    if (box) {
        box.style.transform = "translateY(-5px)";
        box.style.boxShadow = "0 8px 16px rgba(0, 0, 0, 0.2)";
    }
});

document.addEventListener("mouseout", (event) => {
    const box = event.target.closest(".box");
    if (box) {
        box.style.transform = "translateY(0)";
        box.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
    }
});

// Effet de survol et d'interaction pour les boutons de filtre
document.querySelectorAll(".filters button").forEach((button) => {
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

// Fonction pour afficher le popup d'information
function showPopup(event) {
    const popup = document.getElementById("popup-bulle");
    popup.style.display = "flex";
    event.stopPropagation(); // Empêche le clic de se propager
}

// Fonction pour fermer le popup d'information
function closePopup() {
    document.getElementById("popup-bulle").style.display = "none";
}

// Fermer le popup si on clique en dehors du contenu
document.addEventListener("click", (event) => {
    const popup = document.getElementById("popup-bulle");
    const content = document.querySelector(".popup-content");
    if (popup.style.display === "flex" && !content.contains(event.target)) {
        closePopup();
    }
});

// Fonction pour défiler vers le haut
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Fonction pour défiler vers le bas
function scrollToBottom() {
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
}