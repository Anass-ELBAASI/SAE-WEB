<?php
require_once '../app/flash.php';
if(!session_id())
    session_start();


messageFlash();
?>
<!DOCTYPE html>
<html lang="fr">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<script src="../js/loadfooter.js" type="module"></script>
<script src="../js/loadNavBar.js" type="module"></script>
<head>
    <meta charset="UTF-8">
    <title>Acceuil FFCM</title>

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Menu.css">
    <script src="../js/accueil.js" type="module"></script>
    <script src="../js/loadNavBar.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" type="module"></script>
</head>
<body>
<div> <?php
    messageFlash();?> </div>
<div id="navbar-container"></div>

<div class="custom-container">
    <div class="section">
        <a href="./quisommesnous.html">A Propos De Nous</a>
        <img src="../image/SECTION-ACTUALITE/info.png" alt="Image A Propos De Nous">
    </div>

    <div class="section">
        <a href="./actualites.html">Evénements</a>
        <img src="../image/SECTION-ACTUALITE/event.png" alt="Image Evénements">
    </div>

    <div class="section">
        <a href="./documents.html">Informations Importantes</a>
        <img src="../image/SECTION-ACTUALITE/important.png" alt="Image Informations Importantes">
    </div>
</div>

<section class="actualites-section">
    <h2>Au quotidien</h2>
    <p>Plongez au cœur de notre actualité. Découvrez les projets que nous menons, suivez nos mobilisations et apprenez à découvrir notre grande association grâce aux portraits des personnes qui la font vivre au quotidien.</p>

    <div class="actualites">
        <div class="actualite">
            <img src="../image/SECTION-ACTUALITE/actu1.png" alt="Réunion d'information des curistes">
            <h3><a href="https://www.ffcm.info/_files/ugd/cdd428_923f67d9f9d240ed865374e4fada0152.pdf" target="_blank">Réunion d'information des curistes</a></h3>
        </div>
        <div class="actualite">
            <img src="../image/SECTION-ACTUALITE/actu2.png" alt="Réunion d'information des curistes">
            <h3><a href="https://www.ffcm.info/_files/ugd/cdd428_fc1ccc6369ed4eb98984cec28bfd0c81.pdf" target="_blank">Info National Octobre 2024</a></h3>
        </div>
        <div class="actualite">
            <img src="../image/SECTION-ACTUALITE/actu3.png" alt="Ensemble, Résistons !">
            <h3><a href="https://www.ffcm.info/_files/ugd/cdd428_30b8a4883c11447f9518d01f2a2676fe.pdf" target="_blank">Ensemble, Résistons !</a></h3>
        </div>
    </div>
</section>

<section class="partenaires-section">
    <h2>Partenaires</h2>
    <p>Notre association travaille avec un réseau de partenaires qui l'aide à accomplir ses missions au quotidien.</p>
    <div class="logos">
        <div class="logo-item">
            <a href="https://www.femteconline.org/" target="_blank"><img src="../image/SECTION-PARTENAIRE/FEMTEC.png" alt="FEMTEC"></a>
        </div>
        <div class="logo-item">
            <a href="https://www.eaptc.org/" target="_blank"><img src="../image/SECTION-PARTENAIRE/ASSO1.png" alt="EAPTC"></a>
        </div>
        <div class="logo-item">
            <a href="https://curistesdecapvern.wordpress.com/" target="_blank"><img src="../image/SECTION-PARTENAIRE/ASSO3.png" alt="ACCB"></a>
        </div>
        <div class="logo-item">
            <a href="https://universitethermalebarbotan.jimdofree.com/accueil/" target="_blank"><img src="../image/SECTION-PARTENAIRE/ASSO4.png" alt="UTEPSSIA"></a>
        </div>
        <div class="logo-item">
            <a href="https://www.officiel-thermalisme.com/" target="_blank"><img src="../image/SECTION-PARTENAIRE/ASSO5.png" alt="L'Officiel International"></a>
        </div>
        <div class="logo-item">
            <a href="https://www.france-assos-sante.org/" target="_blank"><img src="../image/SECTION-PARTENAIRE/FRANCEASSOSSANTE.png" alt="France Assos Santé"></a>
        </div>
    </div>
    <button class="newsletter-btn" onclick="window.location.href='newsletter.html'">S'inscrire à la newsletter</button>
</section>

<!--Design du bas de la page d'accueil-->

<div id="footer-container"></div>
</body>
</html>