document.addEventListener('DOMContentLoaded', () => {
    const leftBands = document.querySelectorAll('.left-band');
    const rightBands = document.querySelectorAll('.right-band');

    // Configuration de l'Intersection Observer
    const options = {
        threshold: 0, // L'animation se déclenche lorsque 50% de la bande est visible
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('left-band')) {
                    entry.target.classList.add('show-left-band');
                } else if (entry.target.classList.contains('right-band')) {
                    entry.target.classList.add('show-right-band');
                }
                // Une fois l'animation déclenchée, on arrête d'observer l'élément
                observer.unobserve(entry.target);
            }
        });
    }, options);

    // Ajouter chaque bande à l'observateur
    leftBands.forEach(band => observer.observe(band));
    rightBands.forEach(band => observer.observe(band));
});

const elem = document.querySelector(".PDF")
elem.addEventListener('click',()=> window.location.href='https://www.ffcm.info/_files/ugd/cdd428_68a4ac16225240e3a5f2d8a3de40598f.pdf')

// Effet de survol pour les éléments 'box'
document.addEventListener("mouseover", (event) => {
    const box = event.target.closest(".PDF");
    if (box) {
        box.style.transform = "translateY(-5px)";
        box.style.boxShadow = "0 8px 16px rgba(0, 0, 0, 0.2)";
    }
});
document.addEventListener("mouseout", (event) => {
    const box = event.target.closest(".PDF");
    if (box) {
        box.style.transform = "translateY(0)";
        box.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
    }
});