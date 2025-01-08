
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
        formulaireData.map(d => d.age),
        "Répartition des âges"
    );

    // 3. Tableau des Répondants
    createRespondentsTable(
        "#respondentsTable",
        formulaireData.length,
        "Nombre total de répondants"
    );

    // 4. Pourcentage par Région
    createRegionChart(
        "#regionPercentageChart",
        formulaireData.map(d => d.region),
        "Répartition par région"
    );

    // 5. Camembert pour correspondance lieu voulu / lieu actuel
    createPieChart(
        "#lieuMatchChart",
        formulaireData.map(d => d.lieuVoulu === 1 && d.lieuDeVie ? "Correspond" : "Non Correspond"),
        "Correspondance entre lieu voulu et lieu actuel"
    );
});

// Fonction pour créer un camembert
function createPieChart(selector, data, title) {
    const width = 400, height = 400, radius = Math.min(width, height) / 2;

    const counts = Array.from(d3.rollup(data, v => v.length, d => d), ([key, value]) => ({ key, value }));
    const total = d3.sum(counts, d => d.value); // Calcul du total pour les pourcentages
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

    svg.selectAll("text")
        .data(pie(counts))
        .enter().append("text")
        .attr("transform", d => `translate(${arc.centroid(d)})`)
        .style("text-anchor", "middle")
        .style("font-size", "12px")
        .style("fill", "black")
        .text(d => {
            const percentage = ((d.data.value / total) * 100).toFixed(1); // Calcul du pourcentage
            return `${d.data.key} (${percentage}%)`; // Ajout du texte avec pourcentage
        });

    d3.select(selector).insert("h2", "svg").text(title).attr("class", "title");

    // Ajouter les interactions
    addSegmentInteractions(paths);
}


// Fonction pour créer un histogramme
function createHistogram(selector, data, title) {
    const width = 600, height = 400, margin = { top: 20, right: 30, bottom: 40, left: 40 };

    const svg = d3.select(selector).append("svg")
        .attr("width", width).attr("height", height);

    const x = d3.scaleLinear().domain([d3.min(data), d3.max(data)]).range([margin.left, width - margin.right]);
    const bins = d3.histogram().domain(x.domain()).thresholds(x.ticks(10))(data);
    const y = d3.scaleLinear().domain([0, d3.max(bins, d => d.length)]).range([height - margin.bottom, margin.top]);

    const bars = svg.append("g")
        .selectAll("rect")
        .data(bins)
        .enter().append("rect")
        .attr("x", d => x(d.x0))
        .attr("y", d => y(d.length))
        .attr("width", d => x(d.x1) - x(d.x0) - 1)
        .attr("height", d => y(0) - y(d.length))
        .attr("fill", "#4A90E2"); // Default color

    svg.append("g").call(d3.axisBottom(x)).attr("transform", `translate(0,${height - margin.bottom})`);
    svg.append("g").call(d3.axisLeft(y)).attr("transform", `translate(${margin.left},0)`);

    d3.select(selector).insert("h2", "svg").text(title).attr("class", "title");

    // Ajouter les interactions (agrandir les barres au survol)
    bars.on("mouseover", function () {
        d3.select(this)
            .transition()
            .duration(200)
            .attr("fill", "#357ABD")
            .attr("height", d => y(0) - y(d.length) + 10)
            .attr("y", d => y(d.length) - 10);
    })
        .on("mouseout", function () {
            d3.select(this)
                .transition()
                .duration(200)
                .attr("fill", "#4A90E2")
                .attr("height", d => y(0) - y(d.length))
                .attr("y", d => y(d.length));
        });
}

// Fonction pour créer un tableau des répondants
function createRespondentsTable(selector, count, title) {
    const container = d3.select(selector).append("div");
    container.append("h2").text(title);
    container.append("p").text(`Nombre de répondants : ${count}`);
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
