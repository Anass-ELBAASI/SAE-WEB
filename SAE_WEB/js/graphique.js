// Charger les données JSON
Promise.all([
    d3.json('../js/formulaire.json'),
    d3.json('../js/users.json')
]).then(([formulaireData]) => {

    // 1. Camembert pour Lieu de Vie
    createPieChart(
        "#lieuDeVieChart",
        formulaireData.map(d => d.lieuDeVie),
        "Répartition des lieux de vie"
    );

    // 2. Histogramme des Âges
    createHistogram(
        "#ageHistogram",
        formulaireData.map(d => d.age).sort((a, b) => a - b),
        "Répartition des âges"
    );

    // 3. Tableau des Répondants
    createRespondentsTable(
        "#respondentsTable",
        formulaireData.length,
        ""
    );

    // 5. Camembert pour correspondance lieu voulu / lieu actuel
    createPieChart(
        "#lieuMatchChart",
        formulaireData.map(d => d.lieuVoulu == 1 && d.lieuDeVie ? "Correspond" : "Non Correspond"),
        "Correspondance entre lieu voulu et lieu actuel"
    );

    // 6. Histogramme qualité de vie
    createHistogram(
        "#qualiteDeVieChart",
        formulaireData.flatMap(d => d.qualiteDeVie.split(',')),
        "Répartition des réponses sur la qualité de vie"
    );

    // 7. Camembert pour Adaptation CDAPH
    createPieChart(
        "#adaptationCDAPHChart",
        formulaireData.map(d => d.adaptationCDAPH),
        "Répartition des adaptations CDAPH"
    );

    // 8. Tableau Lieu de Vie
    createLieuDeVieTable(
        "#lieuDeVieTable",
        formulaireData.map(d => d.lieuDeVie),
        "Tableau des lieux de vie"
    );

    // 8. Tableau Lieu de Vie
    createLieuDeVieTable(
        "#AHHHH",
        formulaireData.map(d => d.region),
        "Qui a repondu ?"
    );

    // 9. Tableau de l'orientation CDAPH
    createPieChart(
        "#CDAPH",
        formulaireData.map(d => d.adaptationCDAPH),
        "Orientation CDAPH des habitations"
    );
    // 10. Tableau Activités pro ou scolaires
    createLieuDeVieTable(
        "#OHHHH",
        formulaireData.map(d => d.activite),
        "Activité ?"
    );
});

// Fonction pour créer un camembert
function createPieChart(selector, data, title) {
    const width = 400, height = 400, radius = Math.min(width, height) / 2;

    const counts = Array.from(d3.rollup(data, v => v.length, d => d), ([key, value]) => ({ key, value }));
    const total = counts.reduce((sum, d) => sum + d.value, 0);
    const color = d3.scaleOrdinal([
        "#4A90E2", // blue
        "#75688C", // purple
        "#C5416A", // pink
        "#325298"  // dark-blue
    ]);
    const pie = d3.pie().value(d => d.value);
    const arc = d3.arc().innerRadius(0).outerRadius(radius);

    const svg = d3.select(selector).append("svg")
        .attr("width", width).attr("height", height)
        .append("g")
        .attr("transform", `translate(${width / 2},${height / 2})`);

    const paths = svg.selectAll("path")
        .data(pie(counts))
        .enter().append("path")
        .attr("d", arc)
        .attr("fill", d => color(d.data.key));

    // Calculer la taille de la police en fonction du nombre de segments
    const fontSize = counts.length > 5 ? 10 : 12;  // Si plus de 5 segments, réduire la taille de la police

    svg.selectAll("text")
        .data(pie(counts))
        .enter().append("text")
        .attr("transform", d => `translate(${arc.centroid(d)})`)
        .style("font-size", `${fontSize}px`) // Appliquer la taille de la police
        .text(d => `${d.data.key} (${((d.data.value / total) * 100).toFixed(1)}%)`);

    d3.select(selector).insert("h2", "svg").text(title).attr("class", "title");

    // Ajouter les interactions
    addSegmentInteractions(paths);
}

// Fonction pour créer un histogramme
function createHistogram(selector, data, title) {
    const width = 600, height = 400, margin = { top: 20, right: 30, bottom: 100, left: 60 }; // Marges élargies

    const svg = d3.select(selector).append("svg")
        .attr("width", width).attr("height", height);

    const x = d3.scaleBand().domain(data).range([margin.left, width - margin.right]).padding(0.1);
    const counts = Array.from(d3.rollup(data, v => v.length, d => d), ([key, value]) => ({ key, value }));
    const y = d3.scaleLinear().domain([0, d3.max(counts, d => d.value)]).range([height - margin.bottom, margin.top]);

    svg.append("g")
        .selectAll("rect")
        .data(counts)
        .enter().append("rect")
        .attr("x", d => x(d.key))
        .attr("y", d => y(d.value))
        .attr("width", x.bandwidth())
        .attr("height", d => y(0) - y(d.value))
        .attr("fill", "#4A90E2");

    svg.append("g")
        .attr("transform", `translate(0,${height - margin.bottom })`)
        .call(d3.axisBottom(x).tickSize(0))
        .selectAll("text")
        .attr("transform", "rotate(-45)") // Réduire l'angle de rotation
        .style("text-anchor", "end")
        .style("font-size", "10px") // Réduire la taille de la police
        .attr("dy", "0.35em"); // Ajuste la position verticale

    svg.append("g")
        .attr("transform", `translate(${margin.left},0)`)
.call(d3.axisLeft(y));

    d3.select(selector).insert("h2", "svg").text(title).attr("class", "title");
}

// Fonction pour créer un tableau des répondants
function createRespondentsTable(selector, count, title) {
    const container = d3.select(selector).append("div");
    container.append("h2").text(title);
    container.append("p").text(`Nombre de répondants : ${count}`);
}

// Fonction pour créer un tableau Lieu de Vie
function createLieuDeVieTable(selector, data, title) {
    const counts = Array.from(d3.rollup(data, v => v.length, d => d), ([key, value]) => ({ key, value }));
    const total = counts.reduce((sum, d) => sum + d.value, 0);

    const container = d3.select(selector).append("div");
    container.append("h2").text(title);

    const table = container.append("table").attr("class", "lieu-de-vie-table");
    const thead = table.append("thead");
    const tbody = table.append("tbody");

    thead.append("tr")
        .selectAll("th")
        .data(["Lieu de Vie", "Nombre", "Pourcentage"])
        .enter().append("th")
        .text(d => d);

    tbody.selectAll("tr")
        .data(counts)
        .enter().append("tr")
        .selectAll("td")
        .data(d => [d.key, d.value, `${((d.value / total) * 100).toFixed(1)}%`])
        .enter().append("td")
        .text(d => d);
}

// Fonction pour créer un graphique en barres empilées
function createRegionChart(selector, data, title) {
    const counts = Array.from(d3.rollup(data, v => v.length, d => d), ([key, value]) => ({ key, value }));
    createPieChart(selector, counts.map(d => d.key), title);
}

// Ajouter des interactions sur les segments pour chaque graphique
function addSegmentInteractions(selection) {
    selection
        .on('mouseover', function (event, d) {
            d3.select(this)
                .transition()
                .duration(200)
                .attr('transform', function () {
                    const [x, y] = d3.arc().centroid(d);
                    return `translate(${x * 0.1}, ${y * 0.1})`;
                })
                .style('opacity', 0.8);
        })
        .on('mouseout', function () {
            d3.select(this)
                .transition()
                .duration(200)
                .attr('transform', 'translate(0,0)')
                .style('opacity', 1);
        });
}
