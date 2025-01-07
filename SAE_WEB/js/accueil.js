document.addEventListener("DOMContentLoaded", function() {
    const logoItems = document.querySelectorAll('.logo-item');

    logoItems.forEach((item) => {
        const svgNS = "http://www.w3.org/2000/svg";
        const svg = document.createElementNS(svgNS, "svg");
        svg.setAttribute("width", "150");
        svg.setAttribute("height", "150");
        svg.setAttribute("viewBox", "0 0 150 150");
        svg.style.position = "absolute";
        svg.style.top = "0";
        svg.style.left = "0";
        svg.style.zIndex = "0";

        const rect = document.createElementNS(svgNS, "rect");
        rect.setAttribute("width", "150");
        rect.setAttribute("height", "150");
        rect.setAttribute("rx", "30");
        rect.setAttribute("ry", "30");
        rect.setAttribute("fill", "#f1f1f1");
        rect.setAttribute("stroke", "#756B8C");
        rect.setAttribute("stroke-width", "5");
        rect.classList.add("animated-svg");

        svg.appendChild(rect);
        item.prepend(svg);
    });
});
