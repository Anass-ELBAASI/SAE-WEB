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
    <link rel="stylesheet" href="../css/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>
<header>
    <h1><img src="../image/logo.png" alt="Logo FFCM"></h1>
    <nav>
        <ul>
            <li><a href="accueil.html">Accueil</a></li>
            <li><a href="actualites.html">Actualités</a></li>
            <li><a href="quisommesnous.html">Qui Sommes Nous ?</a></li>
            <li><a href="documents.html">Documents</a></li>
            <li id="votreEspace"><a href="page.php">Votre Espace</a>
                <ul class="sous-menu">
                    <?php if ($isLoggedIn): ?>
                        <div class="options-login">
                            <p><?= htmlspecialchars($trousseau->findUserByEmail($_SESSION['email'])->getPrenom()) ?></p>
                            <p><a href="../app/logOut.php">Se déconnecter</a></p>
                            <?php if ($role === '1'): ?> <!-- Si admin -->
                                <p><a href="formulaire.html">Tableau de bord</a></p>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="options-login">
                            <p><a href="page.php">Se connecter</a></p>
                            <p><a href="page.php">Créer un compte</a></p>
                        </div>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<img id="scroll-image" src="../image/Q10.png" class="image-dessous-navbar">

<body>
</body>
</html>
