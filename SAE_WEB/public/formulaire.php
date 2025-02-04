<?php
if(!session_id())
    session_start();
use Romai\SaeWeb\BddConnect;
use Romai\SaeWeb\DBUserRepository;

require_once '../vendor/autoload.php';
$bdd = new BddConnect();

$pdo = $bdd->connexion();
$trousseau = new DBUserRepository($pdo);

$isLoggedIn = $trousseau->isUserLoggedIn();

if ($isLoggedIn) {
    $role = $trousseau->isUserAdmin($_SESSION['email']);
} else {
    $role = false;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquête - Formulaire</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/formulaire.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <script src="../js/loadfooter.js" type="module"></script>
    <script src="../js/loadNavBarSansImage.js" type="module"></script>
</head>

<body>
<header id="navbar-container"></header>

<div class="form-container">
<h1>Enquête de l'association</h1>
<form action="enregistrementForm.php" method="POST">
    <!-- Thème 1 : Qui a répondu à l'enquête ? -->
    <div class="question">
        <label for="region">1. Dans quelle région habitez-vous ?</label>
        <select id="region" name="region" required>
            <option value="" disabled selected>-- Sélectionnez votre région --</option>
            <option value="Auvergne Rhône-Alpes">Auvergne Rhône-Alpes</option>
            <option value="Bourgogne Franche-Comté">Bourgogne Franche-Comté</option>
            <option value="Bretagne">Bretagne</option>
            <option value="Centre-Val-de Loire">Centre-Val-de Loire</option>
            <option value="Corse">Corse</option>
            <option value="Grand-Est">Grand-Est</option>
            <option value="Hauts-de-France">Hauts-de-France</option>
            <option value="Ile-de-France">Ile-de-France</option>
            <option value="Normandie">Normandie</option>
            <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
            <option value="Occitanie">Occitanie</option>
            <option value="Pays de la Loire">Pays de la Loire</option>
            <option value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guyane">Guyane</option>
            <option value="Martinique">Martinique</option>
            <option value="Mayotte">Mayotte</option>
            <option value="La Réunion">La Réunion</option>
            <option value="Je vis à l'étranger">Je vis à l'étranger</option>
        </select>
    </div>

    <div class="question">
        <label for="age">1.1 Quel est votre âge ?</label>
        <input type="number" id="age" name="age" min="0" max="120" required>
    </div>

    <!-- Thème 2 : Lieu de vie -->
    <div class="question">
        <label for="lieu_vie">2. Quel est votre lieu de vie actuel ?</label>
        <select id="lieu_vie" name="lieu_vie" required>
            <option value="" disabled selected>-- Sélectionnez une des reponses --</option>
            <option value="Dans la famille en permanence">Dans la famille en permanence</option>
            <option value="Dans la famille avec une solution d'accueil ou des activités en journée">Dans la famille avec une solution d'accueil ou des activités en journée</option>
            <option value="Dans la famille principalement mais avec un accueil temporaire ou séquentiel en établissement">
                Dans la famille principalement mais avec un accueil temporaire ou séquentiel en établissement
            </option>
            <option value="Dans un logement indépendant">Dans un logement indépendant</option>
            <option value="Dans un habitat inclusif">Dans un habitat inclusif</option>
            <option value="Dans un foyer d'accueil médicalisé (FAM)">Dans un foyer d'accueil médicalisé (FAM)</option>
            <option value="Dans une maison d'accueil spécialisé (MAS)">Dans une maison d'accueil spécialisé (MAS)</option>
            <option value="Dans un foyer de vie ou foyer d'hébergement">Dans un foyer de vie ou foyer d'hébergement</option>
            <option value="En IME avec internat">En IME avec internat</option>
            <option value="Hospitalisation en psychiatrie">Hospitalisation en psychiatrie</option>
            <option value="Autre">Autre</option>
        </select>
    </div>

    <div class="question">
        <label for="orientation_cdaph">3. Le lieu de vie correspond-il à une orientation CDAPH ?</label>
        <select id="orientation_cdaph" name="orientation_cdaph" required>
            <option value="" disabled selected></option>
            <option value="Oui">Oui</option>
            <option value="Non">Non</option>
            <option value="Pas d'orientation CDAPH">Pas d'orientation CDAPH</option>
        </select>
    </div>

    <div class="question">
        <label for="choix_vie">4. Le lieu de vie correspond-il à votre choix ?</label>
        <select id="choix_vie" name="choix_vie" required>
            <option value="" disabled selected></option>
            <option value="Oui">Oui</option>
            <option value="Non">Non</option>
        </select>
    </div>

    <!-- Thème 3 : Insertion professionnelle et insertion sociale -->
    <div class="question">
        <label for="activites_pro">5. Avez-vous des activités scolaires ou professionnelles ?</label>
        <select id="activites_pro" name="activites_pro" required>
            <option value="" disabled selected></option>
            <option value="Scolarité en milieu ordinaire">Scolarité en milieu ordinaire</option>
            <option value="Scolarité en dispositif spécialisé de l'Éducation Nationale">
                Scolarité en dispositif spécialisé de l'Éducation National
            </option>
            <option value="Instruction en Famille">Instruction en Famille</option>
            <option value="Scolarité dans un établissement médico-social (IME, IMPRO…)">
                Scolarité dans un établissement médico-social (IME, IMPRO…)
            </option>
            <option value="Formation professionnelle">Formation professionnelle</option>
            <option value="Études supérieures">Études supérieures</option>
            <option value="Activité professionnelle en milieu ordinaire">
                Activité professionnelle en milieu ordinaire
            </option>
            <option value="Activité professionnelle en milieu protégé (ESAT, Entreprise adaptée)">
                Activité professionnelle en milieu protégé (ESAT, Entreprise adaptée)
            </option>
            <option value="Sans aucune activité scolaire ou professionnelle">
                Sans aucune activité scolaire ou professionnelle
            </option>
            <option value="Autre">Autre</option>
        </select>
    </div>


    <!-- Thème 4 : Qualité de vie -->
    <div class="question">
        <label>6. Comment évaluez-vous votre qualité de vie ? (Choix multiples possibles)</label>
        <fieldset>
            <legend>Sélectionnez les réponses applicables :</legend>
            <input type="checkbox" id="tout_va_bien" name="qualite_vie_detail[]" value="Tout va bien">
            <label for="tout_va_bien">Tout va bien</label><br>

            <input type="checkbox" id="restriction_sociale" name="qualite_vie_detail[]" value="Restriction de la vie sociale">
            <label for="restriction_sociale">Restriction de la vie sociale</label><br>

            <input type="checkbox" id="souffrance_psychologique" name="qualite_vie_detail[]" value="Souffrance psychologique">
            <label for="souffrance_psychologique">Souffrance psychologique</label><br>

            <input type="checkbox" id="fatigue" name="qualite_vie_detail[]" value="Fatigue et épuisement">
            <label for="fatigue">Fatigue et épuisement</label><br>

            <input type="checkbox" id="couts_financiers" name="qualite_vie_detail[]" value="Coûts financiers importants">
            <label for="couts_financiers">Coûts financiers importants</label><br>

            <input type="checkbox" id="impact_famille" name="qualite_vie_detail[]" value="Impact négatif sur la fratrie">
            <label for="impact_famille">Impact négatif sur la fratrie</label><br>

            <input type="checkbox" id="conflits_familiaux" name="qualite_vie_detail[]" value="Conflits familiaux">
            <label for="conflits_familiaux">Conflits familiaux</label><br>

            <input type="checkbox" id="maladie_difficulte" name="qualite_vie_detail[]" value="Maladie ou difficulté pour la personne">
            <label for="maladie_difficulte">Maladie ou difficulté pour la personne</label><br>

            <input type="checkbox" id="eloignement" name="qualite_vie_detail[]" value="Éloignement de la personne">
            <label for="eloignement">Éloignement de la personne</label>
        </fieldset>
    </div>


    <!-- Thème 5 : Besoin de soutien -->
    <div class="question">
        <label for="besoins_soutien">7. De quel type d’interventions l’adhérent a-t-il besoin ?</label>
        <select id="besoins_soutien" name="besoins_soutien" required>
            <option value="" disabled selected></option>
            <option value="Personne totalement autonome">La personne est totalement autonome</option>
            <option value="Aide pour tous les actes de la vie quotidienne">
                Une aide pour tous les actes de la vie quotidienne et la présence d’une tierce personne 24 heures sur 24
            </option>
            <option value="Interventions et stimulations ponctuelles">
                Des interventions et stimulations ponctuelles mais quotidiennes (toilettes, sorties, repas, communication...)
            </option>
            <option value="Soutien à l'autonomie">
                Un soutien à l’autonomie pour le logement, l’accès à la santé, les loisirs, les démarches administratives
            </option>
        </select>
    </div>


    <button type="submit">Soumettre</button>

</form>
</div>
<div class="footer-container"></div>
</body>
</html>
