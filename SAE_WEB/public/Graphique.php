<?php
    require '../app/data.php';
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Analyse des Formulaires</title>
  <link rel="stylesheet" href="../css/graphique.css">
  <script src="https://d3js.org/d3.v7.min.js"></script>
  <script src="../js/graphique.js" type="module"></script>
  <script src="../js/loadNavBarSansImage.js" type="module"></script>
</head>
<body>

<header id="navbar-container"> </header>
<br/><br/><br/><br/>
<div id="charts">
  <div id="respondentsTable" class="chart"></div>
  <div id="lieuDeVieChart" class="chart"></div>
  <div id="ageHistogram" class="chart"></div>
  <div id="regionPercentageChart" class="chart"></div>
  <div id="lieuMatchChart" class="chart"></div>
</div>
</body>
</html>