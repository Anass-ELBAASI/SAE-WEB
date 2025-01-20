<?php
if(!session_id())
    session_start();

require_once '../app/flash.php';

messageFlash();

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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site sécurisé</title>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/lux/bootstrap.min.css">
    <link rel="stylesheet" href="../css/authentification.css">
    <link rel="stylesheet" href="../css/navbar.css">

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" type="module"></script>

    <script src="../js/page.js" type="module"></script>
    <script src="../js/loadfooter.js" type="module"></script>
    <script src="../js/scrollimage.js" type="module"></script>
    <script src="../js/loadNavBarSansImage.js" type="module"></script>
</head>

<body>
<header id="navbar-container"></header>
<div class="container mt-5">
    <h2 class="text-center">Site sécurisé</h2>

    <!-- Section des messages flash -->
    <div> <?php
        messageFlash();?> </div>

    <div class="d-flex justify-content-center my-4">
        <!-- Boutons pour basculer entre les formulaires -->
        <button id="auth-btn" class="btn btn-primary mx-2">Authentification</button>
        <button id="register-btn" class="btn btn-secondary mx-2">Enregistrement</button>
    </div>

    <!-- Formulaire d'authentification -->
    <div id="auth-form" class="form-container active">
        <h3>Authentification</h3>
        <form action="signin.php" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-12">
                <label for="auth-email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="auth-email" placeholder="Votre email..." required>
                <div class="invalid-feedback">Veuillez entrer un email valide.</div>
            </div>
            <div class="col-12">
                <label for="auth-password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="auth-password" placeholder="Votre mot de passe..." required>
                <div class="invalid-feedback">Veuillez entrer votre mot de passe.</div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-primary" type="submit">Se connecter</button>
                <a href="#" class="text-primary text-decoration-none">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>

    <!-- Formulaire d'enregistrement -->
    <div id="register-form" class="form-container">
        <h3>Enregistrement</h3>
        <form action="signup.php" method="post" class="row g-3 needs-validation" novalidate>
            <div class="col-md-6">
                <label for="register-email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="register-email" placeholder="Votre email..." required>
                <div class="invalid-feedback">Veuillez entrer un email valide.</div>
            </div>
            <div class="col-md-6">
                <label for="register-nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" id="register-nom" placeholder="Votre nom..." required>
                <div class="invalid-feedback">Veuillez entrer votre nom.</div>
            </div>
            <div class="col-md-6">
                <label for="register-prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" id="register-prenom" placeholder="Votre prénom..." required>
                <div class="invalid-feedback">Veuillez entrer votre prénom.</div>
            </div>
            <div class="col-md-6">
                <label for="register-password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="register-password" placeholder="Votre mot de passe..." required>
                <div class="invalid-feedback">Veuillez entrer un mot de passe.</div>
            </div>
            <div class="col-md-6">
                <label for="register-repassword" class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="repassword" class="form-control" id="register-repassword" placeholder="Confirmez votre mot de passe..." required>
                <div class="invalid-feedback">Veuillez confirmer votre mot de passe.</div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-outline-danger" type="reset">Annuler</button>
                <button class="btn btn-primary" type="submit">S'inscrire</button>
            </div>
        </form>
    </div>
</div>

<div id="footer-container"></div>
</body>
</html>
