<?php

    use Romai\SaeWeb\BddConnect;
    use Romai\SaeWeb\DBUserRepository;

    require_once '../vendor/autoload.php';
    $bdd = new BddConnect();

    $pdo = $bdd->connexion();
    $trousseau = new DBUserRepository($pdo);
?>
<!DOCTYPE html>
<html lang="fr">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/navbar.css">
</head>

<header>
  <h1><img src="../image/logo.png" alt="Logo FFCM"></h1>
  <nav>
    <ul>
      <li><a href="accueil.html"> Accueil</a></li>
      <li><a href="actualites.html"> Actualités</a></li>
      <li><a href="quisommesnous.html"> Qui Sommes Nous ?</a></li>
      <li><a href="documents.html">Documents</a></li>
      <li id="votreEspace"><a href="page.php">Votre Espace</a>
          <ul class="sous-menu">
            <li><a href="#">Se connecter</a></li>
            <?php if ($trousseau->isUserLoggedIn()): ?>
              <div class="options-login">
                  <p><?=htmlspecialchars($trousseau->findUserByEmail($_SESSION['email'])->getPrenom())?></p>
                  <p><a href="../app/logOut.php">Se deconnecter</a></p></p>
              </div>
              <?php endif; ?>
              <?php if (!$trousseau->isUserLoggedIn()): ?>
                <div class="options-login">
                    <p><a href="page.php">Se connecter</a> </p>
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